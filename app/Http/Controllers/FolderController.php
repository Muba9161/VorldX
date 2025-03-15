<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FolderController extends Controller
{
    // Display the list of folders for the logged-in user, including their subfolders
    public function index()
    {
        // Fetch folders for the logged-in user
        $folders = Folder::where('user_id', Auth::id()) // Only folders of the logged-in user
            ->whereNull('parent_id') // Top-level folders (not subfolders)
            ->with('subfolders') // Load subfolders
            ->get();

        $count = Folder::where('user_id', Auth::id())->whereNull('parent_id')->count(); // Count folders for the logged-in user
        $subcount = Folder::where('user_id', Auth::id())->whereNotNull('parent_id')->count(); // Count folders for the logged-in user

        return view('folders.index', compact('folders', 'count', 'subcount'));
    }

    // Show folder creation form, with option to select a parent folder for subfolders
    public function create()
    {
        $folders = Folder::where('user_id', Auth::id())->get(); // Show all folders for the logged-in user
        return view('folders.create', compact('folders'));
    }

    // Store a new folder for the logged-in user
    public function store(Request $request, $parentId = null)
    {
        // Validate the folder name (optional), optional parent folder, and optional file upload
        $request->validate([
            'name' => 'nullable|string|max:255',  // Folder name is optional
            'parent_id' => 'nullable|exists:folders,id', // Ensure parent_id exists in the folders table
            'file' => 'nullable|file|mimes:jpeg,png,pdf,docx,txt|max:10240', // Validate file types and size
        ]);

        // If parent_id is passed, we set it as the parent folder
        $parentId = $parentId ?: null;  // If parentId is not provided, it will be set as null (root folder)

        // Check if a folder name is provided
        $folder = null;
        if ($request->has('name')) {
            // Create the folder and associate it with the logged-in user
            $folder = Folder::create([
                'name' => $request->name,
                'parent_id' => $parentId, // Use parent_id for subfolders
                'user_id' => Auth::id(),  // Associate the folder with the logged-in user
            ]);
        }

        // Handle file upload if there is a file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public'); // Store file in the 'uploads' directory

            // If a folder was created, associate the file with it
            if ($folder) {
                $folder->file_path = $filePath;
                $folder->save();
            } else {
                // If no folder was created, you can decide whether to store the file elsewhere or just handle it.
                // Optionally, you can create a separate record for the file, or associate it with a generic folder
                // Example: create a "files" table to store file records independently.
            }
        }

        return back()->with('success', 'Folder and/or file uploaded successfully!');
    }



    // Show details of a specific folder for the logged-in user, including subfolders
    public function show(Folder $folder)
    {
        // Ensure the folder belongs to the logged-in user
        if ($folder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $folders = Folder::where('user_id', Auth::id())->get(); // Show folders for the logged-in user
        $subfolders = $folder->subfolders; // Fetch subfolders for the current folder
        $breadcrumb = Folder::getBreadcrumb($folder);

        $count = Folder::where('user_id', Auth::id())->whereNull('parent_id')->count(); // Count folders for the logged-in user
        $subcount = Folder::where('user_id', Auth::id())->whereNotNull('parent_id')->count(); // Count folders for the logged-in user

        return view('folders.show', compact('folder', 'folders', 'count', 'subfolders', 'subcount', 'breadcrumb'));
    }

    // Copy Folder Functionality for the logged-in user
    public function copy(Request $request, Folder $folder)
    {
        // Check if the folder belongs to the logged-in user
        if ($folder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get the current folder where the user is located (this is the destination folder)
        $destinationFolderId = $request->input('destination_folder_id', $folder->parent_id);

        // Copy the folder and its subfolders recursively into the current folder (destination folder)
        $newFolder = $folder->copyTo($destinationFolderId);

        // Return success response with the newly copied folder
        return response()->json([
            'message' => 'Folder copied successfully!',
            'folder' => $newFolder
        ]);
    }

    public function paste(Request $request, $copiedFolderId)
    {
        // Validate the request to ensure the destination folder ID is provided
        $request->validate([
            'destination_folder_id' => 'required|exists:folders,id', // Ensure the destination folder exists
            'parent_id' => 'required|exists:folders,id',             // Ensure the parent folder ID is valid
        ]);

        $destinationFolderId = $request->destination_folder_id;  // Get destination folder ID
        $parentId = $request->parent_id;  // Parent ID of the copied folder

        // Get the copied folder
        $copiedFolder = Folder::findOrFail($copiedFolderId);

        // Ensure the copied folder belongs to the logged-in user
        if ($copiedFolder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get the destination folder
        $destinationFolder = Folder::findOrFail($destinationFolderId);

        // Ensure the destination folder belongs to the logged-in user
        if ($destinationFolder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Ensure the parent folder exists
        $parentFolder = Folder::findOrFail($parentId);
        if ($parentFolder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Copy the folder and its subfolders to the destination folder
        $newFolder = $copiedFolder->copyTo($destinationFolderId);

        // Return a success response with the new folder information
        return response()->json([
            'message' => 'Folder pasted successfully!',
            'folder' => $newFolder
        ]);
    }


    public function download($folderId)
    {
        // Get the folder and its contents
        $folder = Folder::findOrFail($folderId);

        // Define the path for the folder and create a temporary ZIP file
        $zipFileName = 'folder_' . $folder->id . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        // Initialize the ZIP archive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {

            // Add the folder and its contents to the ZIP file
            $this->addFolderToZip($folder, $zip);

            $zip->close();
        }

        // Return the ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    // Helper function to add a folder's files to the ZIP
    private function addFolderToZip(Folder $folder, ZipArchive $zip, $path = '')
    {
        // Add files in this folder
        $files = Storage::files('public/' . $path . $folder->id);
        foreach ($files as $file) {
            $zip->addFile(storage_path('app/' . $file), basename($file));
        }

        // Add subfolders recursively
        foreach ($folder->subfolders as $subfolder) {
            $this->addFolderToZip($subfolder, $zip, $path . $folder->id . '/');
        }
    }



    // Delete Folder for the logged-in user
    public function destroy(Folder $folder)
    {
        // Ensure the folder belongs to the logged-in user
        if ($folder->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized action!',
            ], 403);
        }

        // Delete the folder
        $folder->delete();

        // Return a success message with the folder ID
        return response()->json([
            'message' => 'Folder deleted successfully!',
            'folderId' => $folder->id, // Pass the folder ID to identify which folder was deleted
        ]);
    }
}
