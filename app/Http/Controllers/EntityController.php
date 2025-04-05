<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $entities = User::all();  // Get all entities
        // Group them by parent_id

        // Get the logged-in user's ID
        $userId = Auth::id();

        // Get the logged-in user's entity
        $userEntity = $entities->where('id', $userId)->first();

        $groupedEntities = $entities->groupBy('parent_id');

        $followerIds = DB::table('follows')
            ->where('following_id', $user->id)
            ->pluck('follower_id');

        // Get the follower names from the users table
        $followers = User::whereIn('id', $followerIds)->get();

        // Pass the grouped entities to the view
        return view('entity.index', compact('groupedEntities', 'followers', 'userEntity', 'entities', 'userId'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'entity_name' => 'required|string|max:255',
    //         'password' => 'required|string|min:8',
    //         'parent_id' => 'nullable|integer|exists:entities,id', // Corrected table name
    //     ]);

    //     $entity = new Entity();
    //     $entity->user_id = Auth::id();
    //     $entity->entity_name = $request->input('entity_name');
    //     $entity->password = Hash::make($request->input('password'));
    //     $entity->parent_id = $request->input('parent_id');
    //     $entity->save();

    //     return redirect()->route('entity.index')->with('success', 'Entity Created Successfully');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Name to be saved in users table's name column
            'email' => 'required|string|email|max:255|unique:users', // Email to be saved in users table's email column
            'password' => 'required|string|min:8',
            'parent_id' => 'nullable|integer|exists:users,id',
        ]);

        $user = new User();
        $user->name = $request->input('name'); // Save entity_name as name
        $user->email = $request->input('email'); // Save email as email
        $user->password = Hash::make($request->input('password'));
        $user->parent_id = $request->input('parent_id');
        $user->option = 'work';
        $user->save();

        return redirect()->route('entity.index')->with('success', 'User Created Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Entity $entity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        //
    }
}
