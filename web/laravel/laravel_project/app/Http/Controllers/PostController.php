<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $title = $request->input('title');
        $body = $request->input('body');

        $validate_rules = [
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ];

        $params = [
            'title' => $title,
            'body' => $body,
            'user_id' => $user_id,
        ];
        
        $this->validate($request,$validate_rules);
        Post::create($params);

        return redirect()->route('top')->with('successMessage', '登録に成功しました。');
    }

    public function destroy($post_id)
    {
        Post::where('id', $post_id)->delete();

        return redirect()->route('top')->with('deleteMessage', '投稿を削除しました');
    }

    public function show($post_id)
    {
        $posts = Post::findOrFail($post_id);
        $user = User::find($posts) -> first();
        return view('posts.show', ['posts' => $posts, 'user' => $user]);
    }

    public function profile($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('posts.profile', ['user' => $user]);
    }


}
