<!-- ログインページのメイン部分 -->
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('メールアドレス')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('パスワード')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('ログイン状態を保持する') }}</span>
                </label>
            </div>

            <div class="items-center justify-end mt-2">
                <x-button class="ml-3">
                    {{ __('ログイン') }}
                </x-button>
                <a href="/register" class="signup_a">新規会員登録はこちら</a>
                @if (Route::has('password.request'))
                    <a class="underline text-gray-600 signup_a" href="{{ route('password.request') }}">
                        {{ __('パスワードを忘れた方はこちら') }}
                    </a>
                @endif

                
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
