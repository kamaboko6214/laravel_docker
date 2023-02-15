@extends('layout')

@section('content')
    <div class="container mt-4 mb-5" id="form_area">
        <div class="border p-4">
            <div class="container-header border-bottom border-3 mb-5">
                <p>
                    {{ $user->name }}
                </p>
                <p class="text-secondary">投稿日時：{{ $posts->created_at->format('Y.m.d') }}</p>
                <h1 class="h3 mb-4">
                    {{ $posts->title }}
                </h1>
            </div>
            <p>
                {{ $posts->body }}
            </p>
            <div class="container">
                <div class="row">
                    <button class="btn btn-primary col-2" onclick="createForm()" id="button"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chat-dots" viewBox="0 0 16 16">
                            <path
                                d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            <path
                                d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                        </svg>
                        コメント
                    </button>
                    <form class="col-2" action="{{ route('posts.destroy', ['post' => $posts->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger " onclick="return confirm('本当に削除しますか?')">削除</button>
                    </form>
                </div>
            </div>
        </div>
        <form id="comment_from" class="mt-4" action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $posts->id }}">
        </form>
    </div>
    <div id="comment index" class="container mt-5">
        <h1 class="pt-2 mb-4 h4 border-top border-2">コメント一覧</h1>
        @forelse($posts->comments as $comment)
            <div class="container border-top border-bottom">
                <p class="mt-2">{!! nl2br($comment->user->name) !!}</p>
                <p class="mt-2">{!! nl2br($comment->body) !!}</p>
            <button class="btn btn-primary col-2" onclick="createForm({{$comment->id}})" id={{$comment->id}}>
                返信
            </button>
                <p class="mt-2 text-secondary">{{ $comment->created_at->format('Y.m.d H:i') }}</p>
            </div>
        @empty
            <div class="container">
                <p style="text-align:center">コメントはありません</p>
            </div>
        @endforelse
    </div>
    <script type="text/javascript">
        const createForm = ($comment_id) => {
            var text_data = document.createElement('h1');
            text_data.className = "h3 mt-3";
            text_data.textContent = "コメント投稿";

            var input_data = document.createElement('textarea');
            input_data.name = "body";
            input_data.className = "form-control mt-3";
            input_data.id = "exampleFormControlTextarea1";
            input_data.rows = "6";

            var button = document.createElement('input');
            button.type = "submit";
            button.className = "btn btn-primary mt-2";
            button.value = "送信";
            button.onclick = function(){if(input_data.value === '') { alert('本文は必須です。'); return false;}};

            var parent = document.getElementById('comment_from');
            parent.appendChild(text_data);
            parent.appendChild(input_data);
            parent.appendChild(button);
            
            var button = document.getElementById('button');
            var buttonSub = document.getElementById($comment_id);
            button.disabled = true;
            buttonSub.disabled = true;
        };
    </script>
@endsection
