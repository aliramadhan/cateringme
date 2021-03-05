<x-guest-layout>
     <div class="min-h-screen  flex flex-col sm:justify-center items-center pt-0 md:pt-6  " style="background-image: linear-gradient(60deg,#575fcf,#4bcffa) !important;">
    <div class="w-full md:w-2/6 h-screen sm:h-4/5 px-6 py-6 bg-white shadow-md overflow-hidden md:rounded-lg  shadow ">
       
         <a href="{{ route('login') }}" class="px-4 py-2 font-semibold absolute bg-gray-500 rounded-full text-white hover:bg-gray-700 duration-500 cursor-pointer text-xl"><i class="fas fa-chevron-left"></i></a> 
        <div x-data="{ recovery: false }">
             <img src="{{ asset('/resources/image/logo.png')}}" class="img-fluid mx-auto md:mb-5 my-10" width="138px" height="138px">
            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">

               
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="/two-factor-challenge">
                @csrf


                <div class="mt-4" x-show="! recovery">
                     <div class="relative flex w-full flex-wrap items-stretch mb-3">

                    <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-10 pl-3 py-3">
                       <i class="fas fa-mobile-alt"></i>
                    </span>
                    <x-jet-input id="code" placeholder="{{ __('Enter Your Auth Code') }}"  type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" class="px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pl-12 text-lg hover:border-blue-400 duration-1000"/>
                </div>    

              
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-jet-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </button>


                    <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </button>

                    <x-jet-button class="ml-0 md:ml-4 px-6 py-2 text-center shadow w-full md:w-auto bg-gradient-to-r from-blue-400  to-purple-500 text-white">
                        {{ __('Login') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
