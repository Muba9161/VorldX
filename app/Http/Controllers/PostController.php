<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
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
        $posts = Post::with('replies')->latest()->get();

        foreach ($posts as $post) {
            $formattedTime = Carbon::parse($post->created_at)->setTimezone(config('app.timezone'));
            $post->created_at_formatted = $formattedTime->format('h:i A');
        }


        return view('profile.index', compact('posts', 'user', 'followerCount', 'followingCount', 'following'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // dd($request->all());
        // Add the user_id when creating the post
        Post::create(array_merge(
            $request->only('title', 'content'),
            ['user_id' => Auth::id()]
        ));


        // return redirect()->back();
        return redirect()->route('profile.posts.index')->with('success', 'Post created successfully!');
    }

    public function destroy($post)
    {
        $post = Post::find($post);

        $post->delete();

        return redirect()->route('profile.posts.index')->with('success', 'Post deleted successfully!');
    }
}
