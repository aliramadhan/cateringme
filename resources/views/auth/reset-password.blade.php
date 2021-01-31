<x-guest-layout>
        
   <div class="min-h-screen  flex flex-col sm:justify-center items-center pt-0 md:pt-6  " style="background-image: linear-gradient(60deg,#575fcf,#4bcffa) !important;">
    <div class="w-full md:w-2/6 h-screen sm:h-4/5 px-6 py-6 bg-white shadow-md overflow-hidden md:rounded-lg  shadow ">

        <x-jet-validation-errors class="mb-4" />
     
                           
           

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col">
              <a href="javascript:history.back()" class="px-5 py-2 font-semibold absolute bg-gray-500 rounded-full text-white hover:bg-gray-700 duration-500 cursor-pointer text-2xl"><i class="fas fa-chevron-left"></i></a> 
            @csrf
             <img src="{{ asset('/resources/image/logo.png')}}" class="img-fluid mx-auto md:mb-5 mb-10" width="138px" height="138px">
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div class="relative flex w-full flex-wrap items-stretch mb-3">
                <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-10 pl-3 py-3">
                    <img src="{{ asset('resources/image/name.svg')}}" alt="username" class="w-6 opacity-50" >
                </span>
                <x-jet-input type="email" name="email" :value="old('email', $request->email)" required autofocus placeholder="{{ __('Email') }}" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg hover:border-blue-400 duration-1000"/>
            </div>

            

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
</x-guest-layout>
