<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
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
          <i class="fas fa-calendar-week"></i>
      </button>
      <button onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
          <i class="fas fa-utensils"></i>
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

<div class="relative h-full  overflow-y-hidden overflow-x-hidden ">

   <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide" >

    <div class="grid grid-rows-7 gap-1 w-full ">  

        <h3 class="flex-shrink min-w-0 font-medium text-5xl leading-snug text-center mb-6 h-15 ">
           {{$now->format('F Y')}}
       </h3>  
       <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data" class="contents">
        @csrf
          <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
             <div id="div1" class="grid md:grid-cols-2 grid-cols-1 duration-1000 targetDiv bg-gray-100 justify-content content-center text-center rounded-lg pt-4"> 

                @for($i = 1; $i <= $now->daysInMonth; $i++, $start->addDay())
                @php
                $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
                $order = App\Models\Order::where('order_date',$start->format('Y-m-d'))->first();
                @endphp
                <div class="flex w-full px-4 gap-4">

                    <label class='label flex-auto contents duration-1000'>
                        <input class="label__checkbox duration-1000" type='checkbox' name="dates[]" @if($schedule == null || $start < $now) disabled @endif value="{{$start->format('Y-m-d')}}" id="chkPassport{{$i}}" >

                        <span class='label__text '>
                            <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(@if($order != null)  135deg, #FCCF31 10%, #F55555 100% @elseif($schedule != null) 160deg, #0093E9 0%, #80D0C7 100%  @elseif($start < $now) 160deg, #bdbdbe 0%, #032a32 100% @else to right, #ff416c, #ff4b2b @endif);'>
                              <i class=' @if($start < $now || $schedule == null) cursor-not-allowed @endif fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>

                                <div class='font-semibold text-5xl mb-2 '>{{$start->format('d')}}</div>
                                <div class='text-xs font-base'>{{$start->format('l')}}</div>

                            </i>
                        </span>
                    </span>
                </label>


                <div id="AddPassport{{$i}}"  class="flex md:my-8 my-4 text-xl font-semibold">
                    @if($schedule == null) Date off @elseif($order == null) Empty Order @else {{$order->menu->name}}<br>Submitted @endif
                </div>
                <div id="dvPassport{{$i}}" style="display: none" class="flex flex-col text-lg font-base gap-4 py-4">

                   @if($schedule != null)

                   @foreach(explode(",", $schedule->menu_list) as $menu)
                   @php
                   $menu = App\Models\Menu::where('id',$menu)->first();
                   @endphp


                   <div class="flex ">
                    <input type="radio" name="{{$i}}" value="{{$menu->id}}" class="flex-auto hidden" id="radio{{$i}}{{$menu->id}}">

                    <label for="radio{{$i}}{{$menu->id}}" class="flex cursor-pointer text-base font-semibold items-center">
                     <span class="w-5 h-5 inline-block mr-2 rounded-full border border-grey flex-no-shrink bg-white"></span>
                     {{$menu->name}}</label>
                 </div>


                 @endforeach
                 @endif
             </div>

         </div>



         <script type="text/javascript">
             $(function () {
                $("#chkPassport{{$i}}").click(function () {
                    if ($(this).is(":checked")) {
                        $("#dvPassport{{$i}}").show();
                        $("#AddPassport{{$i}}").hide();
                    } else {
                        $("#dvPassport{{$i}}").hide();
                        $("#AddPassport{{$i}}").show();
                    }
                });
            });
        </script>
        @endfor



    </div></div>



<div class="text-xl row-span-1 text-right pointer px-6 ">
 <input type="submit" name="submit" value="Submit" class="cursor-pointer bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200">
</div>
</div>
</div>
</form>

<div class="absolute inset-0 w-full h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

  <div class="grid grid-rows-7 gap-1 w-full ">  

        <h3 class="flex-shrink min-w-0 font-medium text-4xl leading-snug text-center mb-6 h-15 ">
         {{$next_month->format('F Y')}}
     </h3>  
     <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data" class="contents">
      <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
       <div id="div1" class="grid md:grid-cols-2 grid-cols-1 duration-1000 targetDiv  justify-content content-center text-center rounded-lg pt-4"> 

        @csrf
        <?php $k=60; ?>
        @for($i2 = 1; $i2 <= $next_month->daysInMonth; $i2++, $start->addDay())
        @php
        $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
        $order = App\Models\Order::where('order_date',$start->format('Y-m-d'))->first();
        @endphp
        <div class="flex w-full px-4 gap-4">
            <label class='label flex-auto contents duration-1000'>
                <input class='label__checkbox duration-1000 ' type='checkbox' name="dates[]" @if($schedule == null || $start <= $now) disabled @endif value="{{$start->format('Y-m-d')}}" id="chkPassport{{$i}}" >

                <span class='label__text '>
                    <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(@if($order != null)  135deg, #FCCF31 10%, #F55555 100% @elseif($schedule != null) 160deg, #0093E9 0%, #80D0C7 100%  @elseif($start < $now) 160deg, #bdbdbe 0%, #032a32 100% @else to right, #ff416c, #ff4b2b @endif);'>
                      <i class=' @if($start < $now || $schedule == null) cursor-not-allowed @endif sfa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>

                        <div class='font-semibold text-5xl mb-2 '>{{$start->format('d')}}</div>
                        <div class='text-xs font-base'>{{$start->format('l')}}</div>
                    </i>
                </span>
            </span>
        </label>


        <div id="AddPassport{{$i}}"  class="flex md:my-8 my-4 text-xl font-semibold">
            Date off
        </div>
        <div id="dvPassport{{$i}}" style="display: none" class="flex flex-col text-lg font-base gap-4 py-4">

         @if($schedule != null)

         @foreach(explode(",", $schedule->menu_list) as $menu)
         @php
         $menu = App\Models\Menu::where('id',$menu)->first();
         @endphp


         <div class="flex ">
          <input type="radio" name="{{$i}}" value="{{$menu->id}}" class="flex-auto hidden" id="radio{{$i}}{{$menu->id}}">

          <label for="radio{{$i}}{{$menu->id}}" class="flex cursor-pointer text-base font-semibold items-center">
           <span class="w-5 h-5 inline-block mr-2 rounded-full border border-grey flex-no-shrink bg-white"></span>
           {{$menu->name}}</label>
        </div>


           @endforeach
           @endif
       </div>

   </div>



   <script type="text/javascript">
       $(function () {
        $("#darkslide{{$i2}}").click(function () {
            if ($(this).is(":checked")) {
                $("#dvdark{{$i2}}").show();
                $("#Adddark{{$i2}}").hide();
            } else {
                $("#dvdark{{$i2}}").hide();
                $("#Adddark{{$i2}}").show();
            }
        });
    });
</script>
@endfor



</div></div>
</form>



<div class="text-xl row-span-1 text-right pointer px-6 ">
   <button type="submit" name="submit" id="btn-slide-dis-2y" class="cursor-pointer bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200"> Save</button>
</div>
</div>
</div>


</div>
</div>
</div>
</div>
</div>

<script src="{{asset('resources/js/myJs.js')}}"></script>


</x-app-layout>