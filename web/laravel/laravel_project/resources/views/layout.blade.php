<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel掲示板</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <header class="navbar navbar-dark sticky-top" style="background-color: #34bd3a">
        <div class="container">
            <h3><a class="nav-link nav-item text-white" href="{{ route('top') }}" class="navbar-brand">Laravel掲示板</a>
            </h3>
            <div class="float-end">
                @guest
                    <ul class="nav mb-3">
                        <li class="nav-item mt-2 float-end">
                            <a class="nav-link text-white" id="login" href="{{ route('login') }}">ログイン</a>
                        </li>
                        <li class="nav-item mt-2 float-end">
                            <a class="nav-link text-white" href="{{ route('register') }}">新規登録</a>
                        </li>
                    </ul>
                @endguest
                @auth
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/users/{{ Auth::user()->id }}">プロフィール</a></li>
                            <li><a class="dropdown-item border-bottom" href="#">パスワードの変更</a></li>
                            <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </header>
    @if (session('successMessage'))
        <div class="alert alert-success text-center pt-5">
            {{ session('successMessage') }}
        </div>
    @elseif (session('deleteMessage'))
        <div class="alert alert-danger text-center pt-5">
            {{ session('deleteMessage') }}
        </div>
    @endif
    <div>
        @yield('content')
    </div>
</body>

</html>
