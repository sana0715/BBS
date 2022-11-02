<!-- ログインページのメイン部分 -->
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <h4 class="h4">管理者ログイン</h4>
        <form method="post" action="{{ url('admin/login') }}">
            @csrf
            <div>
              管理者名 <x-input type="text" class="block mt-1 w-full" name="user_name" value=""/>
            </div>
            <div>
              パスワード <x-input type="password" class="block mt-1 w-full" name="password" value="" />
            </div>
            <div>
            <x-button class="ml-3">
              <input type="submit" value="ログイン" />
            </x-button>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>
