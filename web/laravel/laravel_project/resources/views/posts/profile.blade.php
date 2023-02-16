@extends('layout')

@section('content')
    <div class="container" style="display:flex; margin: 30px auto;">
        <div class="container" style="padding: auto; border-radius: 8px; background-color: rgb(236, 236, 236)">
            <h3>名前：{{ $user->name }}</h3>
            <h5>投稿一覧</h5>
            <ul>
                @forelse ($user->posts as $post)
                <li><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }} </a></li> 
                @empty <h3>投稿がありません</h3>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
