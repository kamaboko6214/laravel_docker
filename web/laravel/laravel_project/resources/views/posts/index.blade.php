@extends('layout')

@section('content')
    <div class="container mt-4 ">
        <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">新規投稿</a>
        @forelse ($posts as $post)
            <div class="card mb-4">
                <div>
                    <div>
                        投稿者：<a class="text-muted" href="{{ route('users.show',['user_id' => $post->user->id]) }}">{{ $post->user->name }}</a>
                        <div class="card-header h3">
                            {{ $post->title }}
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $post->body }}
                    </div>
                    <div class="card-footer">
                        投稿日時：{{ $post->created_at->format('Y.m.d') }}
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" type="button"
                            class="btn btn-primary ml-5" style="text-align: right">詳細</a>
                    </div>
                </div>
            </div>
        @empty
            <div>
                <h1 class="text-muted" style="text-align:center">投稿しよう！</h1>
            </div>
        @endforelse
    @endsection
