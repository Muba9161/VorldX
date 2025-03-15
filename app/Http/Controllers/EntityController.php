<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index()
    {
        $entitys = Entity::where('user_id', Auth::id())
            ->whereNull('parent_id')
            ->with('subfolders')
            ->get();

        $count = Entity::where('user_id', Auth::id())->whereNull('parent_id')->count();
        $subcount = Entity::where('user_id', Auth::id())->whereNotNull('parent_id')->count();

        return view('entity.index', compact('entitys', 'count', 'subcount'));
    }

    public function create()
    {
        $entitys = Entity::where('user_id', Auth::id())->get();
        return view('entity.create', compact('entitys'));
    }

    public function store(Request $request, $parentId = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
        ]);

        $parentId = $parentId ?: null;

        Entity::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Folder created successfully!');
    }

    public function show(Entity $entity)
    {
        if ($entity->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $entitys = $entity->entityfolder;
        $count = Entity::where('user_id', Auth::id())->whereNull('parent_id')->count();
        $subcount = Entity::where('user_id', Auth::id())->whereNotNull('parent_id')->count();
        $breadcrumb = Entity::getBreadcrumb($entity);

        return view('entity.show', compact('entity', 'entitys', 'count', 'subcount','breadcrumb'));
    }

    public function copy(Request $request, Entity $entity)
    {
        $request->validate([
            'new_parent_id' => 'nullable|exists:folders,id',
        ]);

        if ($entity->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        session(['copied_folder_id' => $entity->id]);

        return redirect()->route('folders.index')->with('success', 'Folder copied successfully!');
    }

    public function destroy(Entity $entity)
    {
        if ($entity->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized action!',
            ], 403);
        }

        $entity->delete();

        return response()->json([
            'message' => 'Entity deleted successfully!',
            'folderId' => $entity->id,
        ]);
    }
}
