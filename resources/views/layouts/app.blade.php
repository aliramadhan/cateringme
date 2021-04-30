<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('resources/image/logo.png') }}">
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
      function notifu() {
        
      }
    </script>
</head>
<body class="antialiased" onload="loader24();notifu()">
    <div id="loader-bk" class="z-40" >
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
   <div style="display:none;" id="showBody" class="animate-bottom contents">
    <div class="min-h-screen bg-gray-100" >
        <div class="grid grid-cols-10 gap-1 ">
          
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
<footer class="text-gray-600 body-font z-0">
      <div class="container lg:px-5 md:px-4 px-2 py-8 mx-auto flex items-center flex-col md:flex-row">
        <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
         <img class="mb-1 logo-login h-10" src="{{ asset('resources/image/logo2.png')}}" alt="" height="38px">
          <span class="ml-3 text-xl">Malang</span>
        </a>
        <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2021 24Slides —
          <a href="#" class="text-gray-600 ml-1" rel="ADN Dev" target="_blank">ADN</a>
        </p>
         <span class="flex-col text-center sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
          You have problem or suggestion about app ? 
          <a href="mailto:sigit@24slides.com?&cc=fajarfaz@gmail.com&subject=My%20Ask&body=your subject" class="ml-2 font-semibold hover:text-blue-400"> Email Us</a>
         </span> 
      </div>
    </footer>
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
  document.getElementById("showBody").style.display = "block";
}
</script>
<script src="{{ asset('resources/js/modal.js') }}"></script>
<script src="{{ asset('resources/js/notif.js') }}"></script>
</body>
</html>
