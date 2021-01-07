<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <style type="text/css">
        body{
            font-family: 'Poppins', sans-serif;
            background-color: transparent;
        }

    </style>
</head>
<body class=" antialiased">
    <div class="min-h-screen " style="background-image: linear-gradient(60deg,#575fcf,#4bcffa) !important;">

        <div class="grid grid-cols-10 gap-1">
            <div class="col-span-2">
                <div class="flex flex-col p-8 gap-2 ">
                  <div>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                        <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                            <img src="{{ asset('resources/image/plus.svg')}}" alt="lock" class="w-6 opacity-50" >
                        </span>
                        <x-jet-button id="auto" class="ml-0 bg-gradient-to-r px-6 py-2 text-center shadow w-full  bg-gray-200 text-base">
                            {{ __('Schedule') }}
                        </x-jet-button>
                        
                    </div>
                </div>


                <a href="#" class="ml-1 flex gap-3 mt-6 opacity-75 hover:opacity-100 duration-200 text-lg" >
                 <div class="flex-initial  w-5">                    
                     <i class="fa fa-home text-white mr-2" aria-hidden="true"></i>
                 </div>
                 <div class="flex-initial text-white">
                  Dashboard
              </div>
          </a>



          <a href="#"  class="ml-1 flex gap-3 mt-3 opacity-75 hover:opacity-100 duration-200 text-lg ">
            <div class="flex-initial w-5 ">               
                 <i class="fa fa-copy text-white mr-3" aria-hidden="true"></i>
             </div>
             <div class="flex-initial text-white ">
              Files
          </div>
      </a>


          <a href="#" class="ml-1 flex gap-3 mt-3 opacity-75 hover:opacity-100 duration-200 text-lg">
             <div class="flex-initial w-5 ">

                 <i class="fa fa-users  text-white mr-2" aria-hidden="true"></i>
             </div>
             <div class="flex-initial text-white">
              Employees
          </div>
      </a>

          <a href="#" class="ml-1 flex gap-3 mt-3 opacity-75 hover:opacity-100 duration-200 text-lg">
             <div class="flex-initial w-5 ">

                 <i class="fa fa-utensils  text-white mr-3" aria-hidden="true"></i>
             </div>
             <div class="flex-initial text-white">
              Catering
          </div>
        </a>

        <a href="#" class="ml-1 flex gap-3 mt-3 opacity-75 hover:opacity-100 duration-200 text-lg">
         <div class="flex-initial w-5 ">

             <i class="fa fa-database  text-white mr-3" aria-hidden="true"></i>
         </div>
         <div class="flex-initial text-white">
          Database
        </div>
        </a>

        <a href="#" class="flex gap-2 mt-6 text-lg">                 
         <div class="flex-initial text-white font-semibold">
          Saved Report
        </div>
        <div class="flex-initial w-5  opacity-75 hover:opacity-100 duration-200 ">                    
            <i class="fa fa-download  text-white ml-5" aria-hidden="true"></i>

        </div>
        </a>

         <a href="#"  class="ml-1 flex gap-3 mt-3 opacity-75 hover:opacity-100 duration-200 text-lg ">
            <div class="flex-initial w-5 ">               
                 <i class="fas fa-file-alt text-white mr-3" aria-hidden="true"></i>
             </div>
             <div class="flex-initial text-white ">
             Schedule Files
          </div>
      </a>

       <a href="#"  class="ml-1 flex gap-3 mt-3 opacity-75 hover:opacity-100 duration-200 text-lg ">
            <div class="flex-initial w-5 ">               
                 <i class="fas fa-file-alt text-white mr-3" aria-hidden="true"></i>
             </div>
             <div class="flex-initial text-white ">
             Employee Files
          </div>
      </a>

     <a href="#"  class="ml-1 flex gap-3 mt-3 opacity-75 hover:opacity-100 duration-200 text-lg ">
                <div class="flex-initial w-5 ">               
                     <i class="fas fa-file-alt text-white mr-3" aria-hidden="true"></i>
                 </div>
                 <div class="flex-initial text-white ">
                 Calculation Files
              </div>
          </a>


</div>
</div>
<!-- Page Heading -->

<div class="col-span-8">
    @livewire('navigation-dropdown')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main class="bg-gray-100 rounded-bl-2xl mb-10">
        {{ $slot }}
    </main>
</div>
</div>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
