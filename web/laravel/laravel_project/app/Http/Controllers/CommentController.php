<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->input('post_id');
        $body = $request->input('body');

        $validate_rules = [
            'post_id' => 'required',
            'body' => 'required|max:2000',
        ];

        $params = [
            'post_id' => $post_id,
            'body' => $body,
            'user_id' => $user_id,
        ];

        $this->validate($request,$validate_rules);

        $post = Post::findOrFail($params['post_id']);

        $post->comments()->create($params);

        return redirect()->route('posts.show', ['post' => $post, 'user' => $user_id]);
    }


}
