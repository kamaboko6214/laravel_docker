@extends('layout')

@section('content')
    <div class="container ml-4">
        <form action="{{ route('posts.store') }}" method="POST" class="form-horizontal" onsubmit="event.preventDefault();valueCheck();">
            @csrf
            <h1 class="text-#696969">新規投稿</h1>
            <div class="form-group">
                <p>タイトル</p>
                <input id="title" name="title" type="text" class="form-control w-75">
            </div>
            <div class="form-group">
                <p>本文</p>
                <textarea id="body" name="body" class="form-control w-75" rows="5"></textarea>
            </div>
            <button type="submit" name="add" class="btn btn-primary mt-2 btn-lg" >      
                投稿する
            </button>
        </form>
    </div>
    <script type="text/javascript">
        const valueCheck = () => {
            var title = document.getElementById('title');
            var body = document.getElementById('body');
            if (title.value === '') {
                alert('タイトルは必須です。');
                return false;
            }

            if (body.value === '') {
                alert('本文は必須です。');
                return false;
            }
        }
    </script>
@endsection
