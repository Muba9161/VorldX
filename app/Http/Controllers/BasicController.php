<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class BasicController extends Controller
{
    public function coming()
    {
        return view('coming');
    }
    public function followlist()
    {
        $user = FacadesAuth::user();

        $followlistorg = User::all();
        $totalcount = User::all()->count();

        return view('followlist', compact('followlistorg', 'totalcount', 'user'));
    }


    public function orgfollow()
    {
        $user = FacadesAuth::user();

        $followerId = DB::table('follows')->where('following_id', $user->id)->pluck('follower_id');

        $orglist = User::all();
        $followers = User::whereIn('id', $followerId)->get();

        $followingIds = DB::table('follows')
            ->where('follower_id', $user->id)
            ->pluck('following_id');

        $following = User::whereIn('id', $followingIds)->get();

        // return view('profile.show', compact('user', 'followers', 'following'));
        return view('orgfollow', compact('orglist', 'user', 'followers', 'following'));
    }

    public function following()
    {
        $user = FacadesAuth::user();

        $orglist = User::all();

        $followingIds = DB::table('follows')
            ->where('follower_id', $user->id)
            ->pluck('following_id');

        $following = User::whereIn('id', $followingIds)->get();

        // return view('profile.show', compact('user', 'followers', 'following'));
        return view('following', compact('following', 'user', 'following'));
    }
    public function post1()
    {
        return view('post1');
    }
    public function post2()
    {
        return view('post2');
    }

    public function autoLogin($id)
    {
        FacadesAuth::logout();

        $user = User::find($id);

        if ($user) {
            FacadesAuth::login($user);
            return redirect('/dashboard');
        }

        return redirect('/login')->with('error', 'User/Entity not found.');
    }


    public function showFolder($id)
    {
        $search = User::find($id);

        if (!$search) {
            // Handle the case where the user is not found.
            return redirect()->back()->with('error', 'User not found.');
        }

        $folders = Folder::where('user_id', $search->id)->get(); // Use $search->id

        // return redirect()->route('showFolder', compact('folders')); // Incorrect

        return view('folders.show', compact('folders', 'search')); // Render a view, not redirect
    }
}
