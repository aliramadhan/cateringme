<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-image: linear-gradient(60deg,#575fcf,#4bcffa) !important;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Catering App') }}</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </head>
    <body onload="loader24()">
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
        <div class="font-sans text-gray-900 antialiased " >

            {{ $slot }}
          </div>
        </div>
    </body>
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
        <script src="{{ asset('resources/js/modal.js') }}"" defer></script>
</html>

   