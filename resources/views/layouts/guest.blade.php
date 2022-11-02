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
            <div class="header">
                <a href="/login" class="header_logo">
                    <img class="top_img" src="img/135219.png" alt="">
                    BOXING related
                </a>
            </div>
        </nav>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <footer>
            <img class="footer_img" src="img/1255441_2.png" alt="">
            <p class="copy_p" style="bottom: 0;">&copy; 2022 S.Kawano</p>
        </footer>
        
    </body>
</html>
