<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index()
    {
        $user = Auth::user();
        // Get the follower IDs from the follows table
        $followerIds = DB::table('follows')
            ->where('following_id', $user->id)
            ->pluck('follower_id');

        // Get the follower names from the users table
        $followers = User::whereIn('id', $followerIds)->get();

        $followerCount = $followers->count();

        // Get the following IDs from the follows table
        $followingIds = DB::table('follows')
            ->where('follower_id', $user->id)
            ->pluck('following_id');

        // Get the following names from the users table
        $following = User::whereIn('id', $followingIds)->get();

        // Count following
        $followingCount = $following->count();

        return view('profile.index', ['user' => Auth::user()], compact('followers', 'following', 'followerCount', 'followingCount'));
    }

    public function edit(): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request){
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'portfolio_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        $user->phone_number = $request->input('phone_number');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->portfolio_link = $request->input('portfolio_link');
        $user->linkedin_link = $request->input('linkedin_link');
        $user->instagram_link = $request->input('instagram_link');
        $user->facebook_link = $request->input('facebook_link');
        $user->twitter_link = $request->input('twitter_link');

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture); // Delete old profile picture
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = basename($path);
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            if ($user->banner_image) {
                Storage::delete('public/' . $user->banner_image); // Delete old banner image
            }
            $path = $request->file('banner_image')->store('banner_images', 'public');
            $user->banner_image = basename($path);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(User $user)
    {
        $followerIds = DB::table('follows')
            ->where('following_id', $user->id)
            ->pluck('follower_id');

        // Get the follower names from the users table
        $followers = User::whereIn('id', $followerIds)->get();

        $followerCount = $followers->count();

        // Get the following IDs from the follows table
        $followingIds = DB::table('follows')
            ->where('follower_id', $user->id)
            ->pluck('following_id');

        // Get the following names from the users table
        $following = User::whereIn('id', $followingIds)->get();

        // Count following
        $followingCount = $following->count();

        return view('profile.show', compact('user','followers', 'following', 'followerCount', 'followingCount'));
        // return view('profile.show', compact('user'));
    }

    public function follow(User $user)
    {
        if (Auth::user()->id != $user->id) {
            Auth::user()->following()->attach($user->id);
        }
        return back();
    }

    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user->id);
        return back();
    }
}
