<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('entity.show');
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
    public function store(Request $request, $follow_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'access_of' => 'nullable|required|string|max:255',
            'access_by' => 'nullable|required|string|max:255',
            'access_to' => 'nullable|required|string|max:255',
        ]);

        // Fetch the follower entity (Assuming it's a User model or something else)
        $follow = User::find($follow_id);  // or any model that corresponds to the follower

        if ($follow) {
            // Create and store the Access entry
            $access = new Access();
            $access->access_of = $validatedData['access_of'];
            $access->access_by = Auth::id();  // assuming the logged-in user
            $access->access_to = $follow->id;  // Use the follower's id or other relevant value
            $access->save();

            return redirect()->route('entity.show')->with('success', 'Access created successfully');
        } else {
            return redirect()->route('entity.show')->with('error', 'Follower not found');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Access $access)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Access $access)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Access $access)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Access $access)
    {
        //
    }
}
