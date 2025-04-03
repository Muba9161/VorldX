<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QuickAccessFolder; // Assuming you have a QuickAccessFolder model

class QuickAccessController extends Controller
{
    public function index(){

        return view('quick_access_folders');
    }
    public function addToQuickAccess(Request $request)
    {
        $request->validate([
            'folder_id' => 'required|integer',
        ]);

        $user = Auth::user();

        QuickAccessFolder::updateOrCreate(
            ['user_id' => $user->id, 'folder_id' => $request->folder_id],
            ['user_id' => $user->id, 'folder_id' => $request->folder_id]
        );

        return redirect()->back();
        // return response()->json(['message' => 'Folder added to quick access successfully.']);
    }

    public function showQuickAccessFolders()
    {
        $user = Auth::user();
        $folders = QuickAccessFolder::where('user_id', $user->id)->get();

        // If you need folder names, you'll need to fetch them using the folder_id.
        // For example, if you have a Folders table:
        $folderNames = Folder::whereIn('id', $folders->pluck('folder_id'))->pluck('name', 'id')->toArray();

        return view('quick_access_folders', compact('folders','folderNames'));
    }

    public function removeFromQuickAccess(Request $request)
    {
         $request->validate([
            'folder_id' => 'required|integer',
        ]);

        $user = Auth::user();

        QuickAccessFolder::where('user_id', $user->id)
            ->where('folder_id', $request->folder_id)
            ->delete();

        return response()->json(['message' => 'Folder removed from quick access successfully.']);
    }

}
