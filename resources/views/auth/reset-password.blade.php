<x-guest-layout>
        
   <div class="min-h-screen  flex flex-col sm:justify-center items-center pt-0 md:pt-6  " style="background-image: linear-gradient(60deg,#575fcf,#4bcffa) !important;">
    <div class="w-full md:w-2/6 h-screen sm:h-4/5 px-6 py-6 bg-white shadow-md overflow-hidden md:rounded-lg  shadow ">

        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col md:px-4 px-0">
           <div class="flex items-center gap-4">
             <a href="{{ route('login') }}" class="px-4 py-1 font-semibold hover:bg-gray-400 duration-300 rounded-full text-gray-600 hover:text-white cursor-pointer text-2xl"><i class="fas fa-chevron-left"></i></a>
             <label class="font-bold text-3xl text-gray-700 flex-auto  tracking-wide">Set New Password</label>        
         </div>
            @csrf
             <img src="{{ asset('/resources/image/logo.png')}}" class="img-fluid mx-auto md:mb-5 mb-10" width="138px" height="138px">
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div class="relative flex w-full flex-wrap items-stretch mb-3">
                <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-10 pl-3 py-3">
                    <img src="{{ asset('resources/image/name.svg')}}" alt="username" class="w-6 opacity-50" >
                </span>
                <x-jet-input type="email" name="email" :value="old('email', $request->email)" required readonly autofocus placeholder="{{ __('Email') }}" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg hover:border-blue-400 duration-1000"/>
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
                <x-jet-button class="ml-0 md:ml-4 px-8 py-2 text-center shadow w-full md:w-auto bg-gradient-to-r from-purple-500 to-blue-600 text-white">
                    {{ __('Save Password') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
</x-guest-layout>
