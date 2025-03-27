<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch vaults for the logged-in user
        $vaults = Vault::where('user_id', Auth::id()) // Only vaults of the logged-in user
            ->whereNull('parent_id') // Top-level vaults (not subvaults)
            ->with('subvaults') // Load subvaults
            ->get();

        $count = vault::where('user_id', Auth::id())->whereNull('parent_id')->count(); // Count vaults for the logged-in user
        $subcount = vault::where('user_id', Auth::id())->whereNotNull('parent_id')->count(); // Count vaults for the logged-in user

        return view('vaults.index', compact('vaults', 'count', 'subcount'));
    }

    // Show vault creation form, with option to select a parent vault for subvaults
    public function create()
    {
        $vaults = Vault::where('user_id', Auth::id())->get(); // Show all vaults for the logged-in user
        return view('vaults.create', compact('vaults'));
    }

    // Store a new vault for the logged-in user
    public function store(Request $request, $parentId = null)
    {
        try {
            // Validate the vault name (optional), optional parent vault, and optional file upload
            $request->validate([
                'name' => 'nullable|string|max:255',  // vault name is optional
                'parent_id' => 'nullable|exists:vaults,id', // Ensure parent_id exists in the vaults table
                'file' => 'nullable|file|mimes:jpeg,png,pdf,docx,txt|max:10240', // Validate file types and size
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }
        // Check if a vault name is provided
        $vault = null;
        if ($request->has('name')) {
            // Create the vault and associate it with the logged-in user
            $vault = Vault::create([
                'name' => $request->name,
                'parent_id' => $parentId, // Use parent_id for subvaults
                'user_id' => Auth::id(),  // Associate the vault with the logged-in user
            ]);
        }

        // Handle file upload if there is a file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public'); // Store file in the 'uploads' directory

            // If a vault was created, associate the file with it
            if ($vault) {
                $vault->file_path = $filePath;
                $vault->save();
            } else {
                // If no vault was created, you can decide whether to store the file elsewhere or just handle it.
                // Optionally, you can create a separate record for the file, or associate it with a generic vault
                // Example: create a "files" table to store file records independently.
            }
        }

        return back()->with('success', 'vault and/or file uploaded successfully!');
    }



    // Show details of a specific vault for the logged-in user, including subvaults
    public function show(Vault $vault)
    {
        // Ensure the vault belongs to the logged-in user
        if ($vault->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $vaults = Vault::where('user_id', Auth::id())->get(); // Show vaults for the logged-in user
        $subvaults = $vault->subvaults; // Fetch subvaults for the current vault
        $breadcrumb = Vault::getBreadcrumb($vault);

        $count = Vault::where('user_id', Auth::id())->whereNull('parent_id')->count(); // Count vaults for the logged-in user
        $subcount = Vault::where('user_id', Auth::id())->whereNotNull('parent_id')->count(); // Count vaults for the logged-in user

        return view('vaults.show', compact('vault', 'vaults', 'count', 'subvaults', 'subcount', 'breadcrumb'));
    }

    // Copy vault Functionality for the logged-in user
    public function copy(Request $request, Vault $vault)
    {
        // Check if the vault belongs to the logged-in user
        if ($vault->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get the current vault where the user is located (this is the destination vault)
        $destinationvaultId = $request->input('destination_vault_id', $vault->parent_id);

        // Copy the vault and its subvaults recursively into the current vault (destination vault)
        $newvault = $vault->copyTo($destinationvaultId);

        // Return success response with the newly copied vault
        return response()->json([
            'message' => 'vault copied successfully!',
            'vault' => $newvault
        ]);
    }

    public function paste(Request $request, $copiedvaultId)
    {
        // Validate the request to ensure the destination vault ID is provided
        $request->validate([
            'destination_vault_id' => 'required|exists:vaults,id', // Ensure the destination vault exists
            'parent_id' => 'required|exists:vaults,id',             // Ensure the parent vault ID is valid
        ]);

        $destinationvaultId = $request->destination_vault_id;  // Get destination vault ID
        $parentId = $request->parent_id;  // Parent ID of the copied vault

        // Get the copied vault
        $copiedvault = Vault::findOrFail($copiedvaultId);

        // Ensure the copied vault belongs to the logged-in user
        if ($copiedvault->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get the destination vault
        $destinationvault = Vault::findOrFail($destinationvaultId);

        // Ensure the destination vault belongs to the logged-in user
        if ($destinationvault->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Ensure the parent vault exists
        $parentvault = Vault::findOrFail($parentId);
        if ($parentvault->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Copy the vault and its subvaults to the destination vault
        $newvault = $copiedvault->copyTo($destinationvaultId);

        // Return a success response with the new vault information
        return response()->json([
            'message' => 'vault pasted successfully!',
            'vault' => $newvault
        ]);
    }


    public function download($vaultId)
    {
        // Get the vault and its contents
        $vault = Vault::findOrFail($vaultId);

        // Define the path for the vault and create a temporary ZIP file
        $zipFileName = 'vault_' . $vault->id . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        // Initialize the ZIP archive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {

            // Add the vault and its contents to the ZIP file
            $this->addvaultToZip($vault, $zip);

            $zip->close();
        }

        // Return the ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    // Helper function to add a vault's files to the ZIP
    private function addvaultToZip(Vault $vault, ZipArchive $zip, $path = '')
    {
        // Add files in this vault
        $files = Storage::files('public/' . $path . $vault->id);
        foreach ($files as $file) {
            $zip->addFile(storage_path('app/' . $file), basename($file));
        }

        // Add subvaults recursively
        foreach ($vault->subvaults as $subvault) {
            $this->addvaultToZip($subvault, $zip, $path . $vault->id . '/');
        }
    }



    // Delete vault for the logged-in user
    public function destroy(Vault $vault)
    {
        // Ensure the vault belongs to the logged-in user
        if ($vault->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized action!',
            ], 403);
        }

        // Delete the vault
        $vault->delete();

        // Return a success message with the vault ID
        return response()->json([
            'message' => 'vault deleted successfully!',
            'vaultId' => $vault->id, // Pass the vault ID to identify which vault was deleted
        ]);
    }

    public function enterVault(Request $request)
    {
        $request->validate([
            'vault_password' => 'required|string', // Validate password
        ]);

        // Check if the password matches the logged-in user’s password
        $user = Auth::user(); // Get logged-in user
        if (Hash::check($request->vault_password, $user->password)) {
            // Password is correct, allow access
            $request->session()->regenerate();

            session()->flash('status', 'success');
            return redirect()->route('vaults.index');
        }
        
        // Password is incorrect
        return back()->withErrors(['vault_password' => 'Incorrect password.']);
    }
}
