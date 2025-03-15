<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required',
        ]);

        Reply::create([
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id ?? null,
            'content' => $request->content,
        ]);

        return back();
    }
}
