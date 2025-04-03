<?php

namespace App\Http\Controllers;

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
    public function post1(){
        return view('post1');
    }
    public function post2(){
        return view('post2');
    }
}
