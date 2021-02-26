<x-guest-layout>
    <x-jet-authentication-card >
        <x-slot name="logo">

        </x-slot>

        <x-jet-validation-errors />
        <style>
            .modal {
              transition: opacity 0.25s ease;
          }
          body.modal-active {
              overflow-x: hidden;
              overflow-y: visible !important;
          }
      </style>
      @if (session('status'))
      <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    <div class="grid md:grid-cols-7 sm:grid-cols-1 md:mt-5">

     <button class="modal-open visible absolute" id="modal-click" data-toggle="modal" data-target="login-danger"></button>


     <div class="xl:col-span-5 lg:col-span-4 md:col-span-3 sm:col-span-0 hidden md:block  ">
      <div class="flex flex-col px-4 text-left">
        <h1 class="text-5xl font-bold text-white tracking-tight ">Welcome Back to<br> 
        <span class="font-normal"><font class="text-red-600">24</font>Slides Catering App</span></h1><br>
       
      </div>
   
  </div>

  <div class="xl:col-span-2 lg:col-span-3 md:col-span-4 col-span-7 bg-white py-12 px-8 md:rounded-3xl shadow-xl h-screen md:h-auto">

    <form method="POST" action="{{ route('login') }}">
        <img src="{{ asset('/resources/image/logo.png')}}" class="img-fluid mx-auto" width="138px" height="138px">
        @csrf
        <h1 class="text-3xl font-bold text-gray-600 tracking-tight">Log In</h1>
        <p class="mt-1 text-lg text-gray-500 mb-4 font-medium leading-tight">Enter your email and password to log in our app.</p>

        <div class="relative flex w-full flex-wrap items-stretch mb-3">

            <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-10 pl-3 py-3">
                <img src="{{ asset('resources/image/name.svg')}}" alt="username" class="w-6 opacity-50" >
            </span>
            <x-jet-input type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('Email') }}" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg hover:border-blue-400 duration-1000"/>
        </div>       


        <div class="relative flex w-full flex-wrap items-stretch mb-3">
            <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                <img src="{{ asset('resources/image/padlock.svg')}}" alt="lock" class="w-6 opacity-50" >
            </span>
            <x-jet-input  type="password" id="password" name="password" autocomplete="current-password" required autofocus placeholder="{{ __('Password') }}" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg hover:border-blue-400 duration-1000"/>
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="form-checkbox h-5 w-5" name="remember">
                <span class="ml-2 text-sm text-gray-600 font-semibold text-lg">{{ __('remember me') }}</span>
            </label>
        </div>

        <div class="flex md:flex-row flex-col-reverse justify-end md:mt-4 mt-12 gap-4 md:gap-0">
            @if (Route::has('password.request'))
            <a class="underline  text-gray-600 hover:text-gray-900 text-base md:py-2 py-0 content-center text-right text-purple-500 font-semibold no-underline hover:text-purple-700" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-jet-button id="auto" class="ml-0 md:ml-4 px-6 py-2 text-center shadow w-full md:w-auto bg-gradient-to-r from-blue-400  to-purple-500 text-white">
                {{ __('Sign In') }}
            </x-jet-button>
        </div>
    </form>

</div>
</x-jet-authentication-card>
</x-guest-layout>
