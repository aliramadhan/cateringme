<x-guest-layout>
    <div class="min-h-screen  flex flex-col sm:justify-center items-center pt-0 md:pt-6  " style="background: linear-gradient( 90deg,#000000a1,#000000a1 ),url(https://images.pexels.com/photos/2291367/pexels-photo-2291367.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940)">
    
    <div class="w-full lg:w-2/6 md:w-3/6 h-screen sm:h-4/5 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg  shadow ">

        <x-slot name="logo">
        
        </x-slot>

      

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col md:px-4 px-0">
            <div class="flex items-center gap-4">
               <a href="{{ route('login') }}" class="px-4 py-1 font-semibold hover:bg-gray-400 duration-300 rounded-full text-gray-600 hover:text-white cursor-pointer text-2xl"><i class="fas fa-chevron-left"></i></a>
               <label class="font-bold text-3xl text-gray-700 flex-auto  tracking-wide">Forgot Password</label>        
               </div>
            @csrf
            <img src="{{ asset('/resources/image/logo.png')}}" class="img-fluid mx-auto my-5" width="138px" height="138px">
            <div class="mb-4 text-base text-gray-600 ">             
              Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
           </div>
            <div class="relative flex w-full flex-wrap items-stretch mb-3">
                <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-10 pl-3 py-3">
                    <img src="{{ asset('resources/image/name.svg')}}" alt="username" class="w-6 opacity-50" >
                </span>
                <x-jet-input type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('Email') }}" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg hover:border-blue-400 duration-1000"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button id="auto" class="ml-0 md:ml-4 px-6 md:py-2 py-4 text-xl md:text-base text-center shadow-lg w-full md:w-auto bg-gradient-to-r from-blue-500 to-purple-600 text-white md:mb-0 mb-2 tracking-wider px-4">
                {{ __('Send Link') }}
            </x-jet-button>
            </div>
        </form>
    </div>

</div>
</x-guest-layout>
