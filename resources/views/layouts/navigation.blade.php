<!-- ログイン後のナビバー  -->
<nav x-data="{ open: false }" class=" border-b border-gray-100 headernav2">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto lg:px-8">
        <div class="flex justify-between h-16 poji">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:flex headerlink">
                    <a href="/dashboard" class="header_logo">
                        <img class="top_img" src="img/135219.png" alt="">
                        BOXING related
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right">
                    <x-slot name="trigger" class="acount_cont">
                        <div class="navlink">
                            <div>
                                <button class="flex items-center text-sm font-medium hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <!-- <a href="/dashboard" class="a acount_text">@if(Auth::check()) {{ Auth::user()->name }} @endif</a> -->
                                    <a href="{{route('user.index')}}" class="a">@if(Auth::check()) {{ Auth::user()->name }} @endif</a>
                                    <!-- ↑ログインしているかチェックしてログインしているときだけこれを表示という意味でifを追加する -->
                                    
                                    <!-- <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div> -->
                                </button>
                            </div>
                            <div>
                                <button class="flex  items-center text-sm font-medium hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <a href="/home" class="a acount_text nav_a">投稿一覧</a>
                                </button>
                            </div>
                            <!-- <div>
                                <button class="flex  items-center text-sm font-medium hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <a href="#" class="a acount_text">ログアウト</a>
                                </button>
                            </div> -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
        
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="a acount_text nav_a">
                                    {{ __('ログアウト') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger(ハンバーガーメニューボタン) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-black hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <!-- <div class="font-medium text-base"><a href="" class="a">@if(Auth::check()) {{ Auth::user()->name }}  @endif</a></div> -->
                <div class="font-medium text-base"><a href="{{route('user.index')}}" class="a">@if(Auth::check()) {{ Auth::user()->name }}  @endif</a></div>
                <div class="font-medium text-sm">@if(Auth::check()) {{ Auth::user()->email }} @endif</div>
                <div class="font-medium text-base"><a href="/home" class="a">投稿一覧</a></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"  class="a acount_text">
                        {{ __('ログアウト') }}
                    </x-responsive-nav-link>
                </form>
                <div class="mt-3 space-y-1">
                </div>
            </div>

        </div>
    </div>
</nav>
