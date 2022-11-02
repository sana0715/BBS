<!-- ログイン後のheader・footer部分 -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

         <!-- Styles -->
         <link rel="stylesheet" href="{{ asset('css/app.css') }}">
         <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
         <link rel="stylesheet" href="{{ asset('css/style.css') }}">
         
         <!-- Scripts -->
         <script src="{{ asset('js/app.js') }}" defer></script>
         <script src="{{ asset('js/nice.js') }}" defer></script>
         <script src="{{ asset('js/like.js') }}" defer></script>

         <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

        <!-- Scripts -->
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

         <!-- ↓足した -->
       <link rel="stylesheet" href="./css/reset.css">
        <link rel="stylesheet" href="./css/style.css?v=2"> 

        <!-- head内 -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- fontawesame -->
        <script src="https://kit.fontawesome.com/f6d6cc5408.js" crossorigin="anonymous"></script>



        <!-- <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet"> -->
        <!-- <link href="{{asset('/assets/css/reset.css')}}" rel="stylesheet"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     
    </head>
    <body class="font-sans antialiased">
        <div>
        <!-- <div class="min-h-screen bg-gray-100"> -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header>
            <!-- <header class="bg-white shadow"> -->
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <!-- <main class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8"> -->
            <main class="max-w-7xl mx-auto lg:px-8">
                {{ $slot }}
            </main>
        </div>
        <footer class="footer-2">
            <p class="copy_p">&copy; 2022 S.Kawano</p>
        </footer>
    </body>
</html>
