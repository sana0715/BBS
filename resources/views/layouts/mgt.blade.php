<!-- 共通header・footer(ログイン前) -->
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
                <a href="/login" class="header_logo" style="">
                    <img class="top_img" src="img/135219.png" alt="">
                    BOXING related <span style="font-size: 20px; font-weight: bold;">(管理者専用)</span>
                </a>
                <form class="mgt_out" method="post" action="{{ url('admin/logout') }}">
                    @csrf
                    <input class="mgt_out" type="submit" value="ログアウト" />
                </form>
            </div>
        </nav>
        <body class="font-sans antialiased">
        <div>
        <!-- <div class="min-h-screen bg-gray-100"> -->
            <!-- @include('layouts.navigation') -->

            <!-- Page Heading -->
            <header>
            <!-- <header class="bg-white shadow"> -->
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>
        <footer class="footer_mgt">
            <p class="copy_p">&copy; 2022 S.Kawano</p>
        </footer>
    </body>
</html>
