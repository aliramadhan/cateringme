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
  
     
         <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('resources/css/bootstrapcustom.min.css')}}">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css">

       <!-- bootstrap table -->
     <script src="{{asset('resources/table/tableExport.min.js')}}"></script>
     <script src="{{asset('resources/table/bootstrap-table.min.js')}}"></script>
     <script src="{{asset('resources/table/bootstrap-table-locale-all.min.js')}}"></script>
     <script src="{{asset('resources/table/bootstrap-table-export.min.js')}}"></script>

 
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
    <script type="text/javascript">
      function notifu(){}
    </script>
   
</head>
<body class="antialiased" onload="loader24();notifu()">
    <div id="loader-bk" >
    <div id="loader">
      <div class="spinner">
        <svg version="1.1" id="L3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
        <circle fill="none" stroke="#fff" stroke-width="4" cx="50" cy="50" r="44" style="opacity:0.7;"/>
        <circle fill="#fff" stroke="#5294E3" stroke-width="3" cx="8" cy="54" r="6" >
         <animateTransform
         attributeName="transform"
         dur="2s"
         type="rotate"
         from="0 50 48"
         to="360 50 52"
         repeatCount="indefinite" />

       </circle>
     </svg>
      </div>

    </div>
  </div>
   <div style="display:none;" id="myDiv" class="animate-bottom contents">
    <div class="min-h-screen bg-gray-100" >
        <div class="grid grid-cols-10 gap-1 ">
           <!--  <div class="col-span-0 md:col-span-2 hidden md:block ">
                <div class="flex flex-col p-8 gap-2 ">
                  <div>
                    <div class="relative flex w-full flex-wrap items-stretch mb-3">
                        <span class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                            <img src="{{ asset('resources/image/plus.svg')}}" alt="lock" class="w-6 opacity-50" >
                        </span>
                       
                        <x-jet-button id="auto" class="ml-0 bg-gradient-to-r px-6 py-2 text-center shadow w-full  bg-gray-200 text-base" >
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
</div> -->

<!-- <div class="col-span-10 md:col-span-8"> -->
 
    <div class="col-span-10 md:col-span-10">
      @livewire('navigation-dropdown')
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>

      <!-- Page Content -->

      <main class="bg-gray-100 ">

        {{ $slot }}
      </main>
    </div>
  </div>

</div>
</div>

@stack('modals')

@livewireScripts
<script type="text/javascript">

  var myVar;
  function loader24() {
    myVar = setTimeout(showPage, 300);
  }

  function showPage() {
    document.getElementById("loader-bk").style.display = "none";
    document.getElementById("loader").style.display = "none";  
    document.getElementById("myDiv").style.display = "block";
  }


</script>

<script src="{{ asset('resources/js/modal.js') }}"></script>
<script src="{{ asset('resources/js/notif.js') }}"></script>
</body>
</html>
