@extends('layout')

@section('content')
    <div class="container" style="display:flex; margin: 30px auto;">
        <div class="container" style="padding: auto; border-radius: 8px; background-color: rgb(236, 236, 236)">
            <h3>{{ $user->name }}</h3>
        </div>
        <div class="container" style="padding: auto; margin-left: 30px; border-radius: 8px; background-color: rgb(236, 236, 236);">
            <h3>投稿一覧</h3>
        </div>
    </div>
@endsection
