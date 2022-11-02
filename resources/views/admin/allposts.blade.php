<!-- ログイン後管理者画面 -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- ↓足した -->
        <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/style.css?v=2">
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
         
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body>
        <nav class="header_nav">
            <div class="header header_mgt" style="display: flex;">
                <a href="/admin" class="header_logo">
                    <img class="top_img" src="img/135219.png" alt="">
                    BOXING related <span style="font-size: 20px; font-weight: bold;">(管理者専用)</span>
                </a>
                <form class="mgt_out" method="post" action="{{ url('admin/logout') }}">
                    @csrf
                    <input class="mgt_out" type="submit" value="ログアウト" />
                </form>
            </div>
        </nav>

        <!-- Page Heading -->
        <header>
            <!-- <header class="bg-white shadow"> -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                
            </div>
        </header>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
            <!-- <main> -->
            @if(session('message'))
            <div class="alert alert-dark">{{session('message')}}</div>
            @endif
            <div class="main_display">
            @forelse($posts as $post)
            {{ csrf_field() }}
            <div class="one_cont2" style="display: block;">
            <p style="font-weight: bold;"><a href="{{ route('users.show', $post->user_id)}}" class="maincat_a">{{$post->user->name}}</a></p>          
                <img src="{{asset('storage/images/'.$post->image)}}" class="" style="height: 200px;" alt="">
                <p>{{ $post->image }}</p>
                <p>分野：{{ $post->category_id }}</p>
                <p>内容：{{ $post->content }}</p>
                <p>投稿日時：{{ $post->created_at }}</p>
            </div>
            @empty
            @endforelse
            <!-- </main> -->
          </div>
        </div>
        <div class="d-flex justify-content-center mb-5" style="margin-top: 10px;">
          {{ $posts->links() }}
        </div>
    </div>
    
        <footer class="footer-2">
            <p class="copy_p">&copy; 2022 S.Kawano</p>
        </footer>
    </body>
</html>
