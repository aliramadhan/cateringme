<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
      </x-slot>
       <link rel="stylesheet" href="{{asset('resources/css/Foodcheckbox.css')}}" />
      
      <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
      <div id="success" class="invisible absolute"></div>
      <div id="failure" class="invisible absolute"></div>


      @if (session('message'))
      <script type="text/javascript">
        function notifu(){
          document.getElementById('success').click();
          var scriptTag = document.createElement("script");        
          document.getElementsByTagName("head")[0].appendChild(scriptTag);
        }          
      </script>
      <style type="text/css">  .success:before{
        Content:" {{ session('message') }}";
      }</style>


      @endif
      @if($errors->any())
      <script type="text/javascript">
        function notifu(){
          document.getElementById('failure').click();
          var scriptTag = document.createElement("script");        
          document.getElementsByTagName("head")[0].appendChild(scriptTag);
        }          
      </script>
      <style type="text/css">  .failure:before{
        Content:"{{ implode('', $errors->all(':message')) }}";
      }</style> 
  @endif

    <link rel="stylesheet" href="{{ asset('resources/css/date.css') }}">
    <style type="text/css">

        input[type="radio"] + label span {
            transition: background .2s,
            transform .2s;
        }

        input[type="radio"] + label span:hover,
        input[type="radio"] + label:hover span{
          transform: scale(1.2);
      } 

      input[type="radio"]:checked + label span {
          background-color: #3490DC; //bg-blue
          box-shadow: 0px 0px 0px 2px white inset;
      }

      input[type="radio"]:checked + label{
         color: #3490DC; //text-blue
     }
      input[type="radio"]:checked + label:before{
          display: none;
     }
     :checked + .not-menu label:before{
      display: none
     }
      label:before{
         line-height: 160px;
       }

 </style>
 <div class="py-12">
  <div class="max-w-7xl mx-auto lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
      <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
        <div class="flex-shrink min-w-0 flex items-center">
          <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
            Selection of schedule for order
        </h3>
    </div>
    <div class="ml-4 flex flex-shrink-0 items-center cursor-pointer">
      <div class="flex items-center text-sm sm:hidden">
        <button onclick="previousSlide()" id="btn-slide-dis" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
          <i class="fas fa-backward"></i>
      </button>
      <button onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
          <i class="fas fa-forward"></i>
      </button>
  </div>
  <div class="hidden sm:flex items-center text-sm md:text-base">
    <button id="btn-slide-disx" onclick="previousSlide()"   class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600 ">
      {{$now->format('F Y')}}
  </button>
  <button id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
      {{$next_month->format('F Y')}}
  </button>

</div>
<div class="hidden sm:flex sm:items-center">
    <div class="pl-4 pr-4 self-stretch">
        <div class="h-full border-l border-gray-200"></div>
    </div>
    <a @click="$refs[`${activeSnippet}ClipboardCode`].select(); document.execCommand('copy')" class="ml-3 text-gray-400 hover:text-gray-500" >
        <i class="fas fa-calendar-week"></i>
    </a>
</div>
</div>
</div>

<?php for ($modal=1; $modal < 30; $modal++) { 
  # code...
  ?>
  <div class="bootstrapiso z-50 contents">
    <div class="modal fade" id="ScheduleModal{{$modal}}" tabindex="-1" role="dialog" aria-labelledby="MenuPhotosModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="MenuPhotosModal">Create Schedule {{$modal}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="right-4">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-0">
         <div id="carouselExampleControls{{$modal}}" class="carousel slide" data-interval="false">
          <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
              <div class="grid grid-cols-2 ">
               <input type="checkbox" id="menu1{{$modal}}"  value="menu1{{$modal}}" class="schedule-menu hidden" >
               <label for="menu1{{$modal}}" >
                <img class="d-block w-100" src="https://images.pexels.com/photos/708587/pexels-photo-708587.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="First slide">

              </label>
              <input type="checkbox" id="menu2{{$modal}}"  value="menu2{{$modal}}" class="schedule-menu hidden" >
              <label for="menu2{{$modal}}" >
               <img class="d-block w-100" src="https://images.pexels.com/photos/708587/pexels-photo-708587.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="First slide">
             </label>
           </div>

            </div>

            <div class="carousel-item h-100">
              <div class="flex " id="d-menu">
                <input type="radio" name="{{$modal}}" value="L" class="flex-auto hidden" id="nasiL{{$modal}}">

                <label for="nasiL{{$modal}}" class="flex cursor-pointer text-base font-semibold items-center not-menu">
                 
                 Nasi L
               </label>
             </div>
             <div class="flex " id="d-menu">
              <input type="radio" name="{{$modal}}" value="M" class="flex-auto hidden" id="nasiM{{$modal}}">

              <label for="nasiM{{$modal}}" class="flex cursor-pointer text-base font-semibold items-center not-menu">
               
               Nasi M
             </label>
           </div>
           <label class="inline-flex items-center mt-3">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" checked><span class="ml-2 text-gray-700">Sambal</span>
            </label>
            </div>

            <div class="carousel-item h-100">
               <div class="flex " id="d-menu">
                <input type="radio" name="{{$modal}}" value="A" class="flex-auto hidden" id="shiftA{{$modal}}">

                <label for="shiftA{{$modal}}" class="flex cursor-pointer text-base font-semibold items-center not-menu">
                 
                 Shift A
               </label>
             </div>
             <div class="flex " id="d-menu">
              <input type="radio" name="{{$modal}}" value="B" class="flex-auto hidden" id="shiftB{{$modal}}">

              <label for="shiftB{{$modal}}" class="flex cursor-pointer text-base font-semibold items-center not-menu">
               
              Shift B
             </label>
           </div>
            </div>
          </div>
         
        </div>
       </div>
       <div class="modal-footer">
         <a  href="#carouselExampleControls{{$modal}}" role="button" data-slide="prev">
          <button type="button" class="btn btn-warning">Back</button>
        </a>
         <a  href="#carouselExampleControls{{$modal}}" role="button" data-slide="next">
          <button type="button" class="btn btn-primary">Next</button>
        </a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
</div>  
<?php
} 
$modal=1;
?>

<div class="relative h-full  overflow-y-hidden overflow-x-hidden ">

   <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide" >

    <div class="grid grid-rows-7 gap-1 w-full ">  

        <h3 class="flex-shrink min-w-0 font-medium text-5xl leading-snug text-center mb-6 h-15 ">
           {{$now->format('F Y')}}
       </h3>  
       <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data" class="contents">
          <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
             <div id="div1" class="duration-1000 targetDiv bg-gray-100 justify-content content-center text-center rounded-lg pt-4"> 

                @csrf

                @for($i = 1; $i <= $now->daysInMonth; $i++, $start->addDay())
                @php
               
                $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
                $order = App\Models\Order::where('order_date',$start->format('Y-m-d'))->first();
                @endphp
                    
            
                    <label class='label flex-auto contents duration-1000'>
                        <input class='label__checkbox duration-1000 ' type='checkbox'  data-toggle="modal" data-target="#ScheduleModal{{$modal++}}"  @if($schedule == null || $start < $now) disabled @endif value="{{$start->format('Y-m-d')}}">

                        <span class='label__text '>
                            <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient( @if($order != null)  135deg, #FCCF31 10%, #F55555 100% @elseif($start < $now) 160deg, #bdbdbe 0%, #032a32 100% @elseif($schedule != null) 160deg, #0093E9 0%, #80D0C7 100%   @else to right, #ff416c, #ff4b2b @endif );'>
                              <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>

                                <div class='font-semibold text-5xl mb-2 '>{{$start->format('d')}}</div>
                                <div class='text-xs font-base'>{{$start->format('l')}}</div>

                            </i>
                        </span>
                    </span>
                </label>
         
        @endfor

    </div></div>



<div class="text-xl row-span-1 text-right pointer px-6 ">
 <input type="submit" name="submit" value="Save Schedule" class="cursor-pointer bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200">
</div>
</div>
</div>
</form>

<div class="absolute inset-0 w-full h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

  <div class="grid grid-rows-7 gap-1 w-full ">  

        <h3 class="flex-shrink min-w-0 font-medium text-5xl leading-snug text-center mb-6 h-15 ">
         {{$next_month->format('F Y')}}
     </h3>  
     <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data" class="contents">
      <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
       <div id="div1" class="duration-1000 targetDiv  justify-content content-center text-center rounded-lg pt-4"> 

        @csrf
        @for($i = 1; $i <= $next_month->daysInMonth; $i++, $start->addDay())
        @php
        $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
        $order = App\Models\Order::where('order_date',$start->format('Y-m-d'))->first();
        @endphp
        <div class="flex w-full px-4 gap-4">

              <label class='label flex-auto contents duration-1000'>
                        <input class='label__checkbox duration-1000 ' type='checkbox' name="dates[]" @if($schedule == null) disabled @endif value="{{$start->format('Y-m-d')}}" id="darkslide{{$i}}" >

                        <span class='label__text '>
                            <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient( @if($order != null)  135deg, #FCCF31 10%, #F55555 100% @elseif($schedule != null) 160deg, #0093E9 0%, #80D0C7 100%  @elseif($start < $now) 160deg, #bdbdbe 0%, #032a32 100% @else to right, #ff416c, #ff4b2b @endif );'>
                              <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>

                                <div class='font-semibold text-5xl mb-2 '>{{$start->format('d')}}</div>
                                <div class='text-xs font-base'>{{$start->format('l')}}</div>

                            </i>
                        </span>
                    </span>
                </label>


        <div id="Adddark{{$i}}" class="text-xl grid font-semibold pb-9 pt-4 items-center text-left">
         @if($schedule == null)
         <font class="text-3xl text-red-400"> Date off </font>
         @elseif($order == null)
         <font class="text-3xl"> Empty Order </font>
         @else 
         <font>{{$order->menu->name}}</font>
         <font class="text-green-400">Submitted</font> 
         @endif
        </div>
        <div id="dvdark{{$i}}" style="display: none" class="flex flex-col text-lg font-base gap-4 py-4">

         @if($schedule != null)

         @foreach(explode(",", $schedule->menu_list) as $menu)
         @php
         $menu = App\Models\Menu::where('id',$menu)->first();
         @endphp


         <div class="flex ">
            <input type="radio" name="{{$i}}" value="{{$menu->id}}" class="flex-auto hidden" id="radio1{{$i}}{{$menu->menu_code}}">

            <label for="radio1{{$i}}{{$menu->menu_code}}" class="flex cursor-pointer text-base font-semibold items-center">
               <span class="w-5 h-5 inline-block mr-2 rounded-full border border-grey flex-no-shrink bg-white"></span>
               {{$menu->name}}</label>
           </div>


           @endforeach
           @endif
       </div>

   </div>



   <script type="text/javascript">
       $(function () {
        $("#darkslide{{$i}}").click(function () {
            if ($(this).is(":checked")) {
                $("#dvdark{{$i}}").show();
                $("#Adddark{{$i}}").hide();
            } else {
                $("#dvdark{{$i}}").hide();
                $("#Adddark{{$i}}").show();
            }
        });
    });
</script>
@endfor



</div></div>



<div class="text-xl row-span-1 text-right pointer px-6 ">
   <input type="submit" name="submit" value="Save Schedule" class="cursor-pointer bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200">
</div>
</div>
</div>
</form>


</div>
</div>
</div>
</div>
</div>

<script src="{{asset('resources/js/myJs.js')}}"></script>


</x-app-layout>