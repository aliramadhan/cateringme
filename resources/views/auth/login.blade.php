<x-guest-layout class="bg-blue">
    <x-jet-authentication-card >
        <x-slot name="logo">

        </x-slot>

        <x-jet-validation-errors class="mb-4" />
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


    

        <div class="grid md:grid-cols-6 sm:grid-cols-1 gap-4 h-4/5">

   <button class="modal-open visible absolute" id="modal-click"></button>
  
 

             
  <!--Modal-->
  


            <div class="md:col-span-4 sm:col-span-0 hidden md:block ">
                  <div class="flex items-center absolute p-4"><h1 class="text-3xl font-bold text-gray-600 tracking-tight ">Welcome Back to<br> <span class="font-normal"><font class="text-red-600">24</font>Slides Catering App</span></h1>
                  </div>
                <img src="{{ asset('/resources/image/undraw_eating_together_tjhx.svg')}}" class="img-fluid p-5 relative " >
            </div>

            <div class="md:col-span-2 sm:col-span-6">
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

                        <div class="flex md:flex-row flex-col-reverse justify-end md:mt-4 mt-12 gap-4 md:gap-0">
                            @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 text-lg md:py-2 py-0 content-center text-right" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif

                            <x-jet-button id="auto" class="ml-0 md:ml-4 bg-gradient-to-r  from-yellow-400 via-red-500 to-pink-500 px-6 py-2 text-center shadow w-full md:w-auto bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500">
                                {{ __('Sign In') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </x-jet-authentication-card>
    </x-guest-layout>
 
<script>

    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
        event.preventDefault()
        toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
        isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
      }
    };
    
    
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
     
  </script>