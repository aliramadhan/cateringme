<x-guest-layout class="bg-blue">
    <x-jet-authentication-card >
        <x-slot name="logo">

        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif
        <div class="grid grid-cols-6 gap-4 h-4/5">

            <div class="col-span-1 lg:col-span-4">
                  <div class="flex items-center absolute p-4"><h1 class="text-3xl font-bold text-gray-600 tracking-tight ">Welcome Back to<br> <span class="font-normal"><font class="text-red-600">24</font>Slides Catering App</span></h1>
                  </div>
                <img src="{{ asset('/resources/image/undraw_eating_together_tjhx.svg')}}" class="img-fluid p-5 relative " >
            </div>

            <div class="col-span-1 lg:col-span-2">
                <img src="{{ asset('/resources/image/logo.png')}}" class="img-fluid mx-auto" width="138px" height="138px">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="flex items-center"><h1 class="text-3xl font-bold text-gray-600 tracking-tight">Log In</h1></div>

                    <p class="mt-1 text-lg text-gray-500 border-b-1 mb-4 font-medium">Enter your email and password to log in our app.</p>

                    <div>     
                        <div class="relative flex w-full flex-wrap items-stretch mb-3">
                            <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-10 pl-3 py-3">
                                <img src="{{ asset('resources/image/name.svg')}}" alt="username" class="w-6 opacity-50" >
                            </span>
                            <x-jet-input type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('Email') }}" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg"/>
                        </div>
                    </div>

                    <div class="mt-4">

                        <div class="relative flex w-full flex-wrap items-stretch mb-3">
                            <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                                <img src="{{ asset('resources/image/padlock.svg')}}" alt="lock" class="w-6 opacity-50" >
                            </span>
                            <x-jet-input  type="password" id="password" name="password" autocomplete="current-password" required autofocus placeholder="{{ __('Password') }}" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg"/>


                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <input id="remember_me" type="checkbox" class="form-checkbox  text-lg" name="remember">
                                <span class="ml-2 text-sm text-gray-600  text-lg">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 text-lg" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif

                            <x-jet-button class="ml-4 bg-gradient-to-r  from-yellow-400 via-red-500 to-pink-500 px-6 py-2 text-center shadow  bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500">
                                {{ __('Sign In') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </x-jet-authentication-card>
    </x-guest-layout>
