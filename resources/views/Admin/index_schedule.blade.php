<x-app-layout>
    <x-slot name="header">
      <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedule Order ') }}
        </h2>
    </x-slot>
   
    <link rel="stylesheet" href="{{ asset('resources/css/date.css') }}">
    <link rel="stylesheet" href="{{asset('resources/css/Foodcheckbox.css')}}" />

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
      Content:"  {{ implode('', $errors->all(':message')) }}";
    }</style>

    @endif
    


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
              Schedule
            </button>
            <button id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
              Food Menu
            </button>

          </div>
          <div class="hidden sm:flex sm:items-center">
            <div class="pl-4 pr-4 self-stretch">
            <div class="h-full border-l border-gray-200"></div>
            </div>
            <button @click="$refs[`${activeSnippet}ClipboardCode`].select(); document.execCommand('copy')" class="ml-3 text-gray-400 hover:text-gray-500" >
            <i class="fas fa-calendar-week"></i>
            </button>
          </div>
        </div>
      </div>
 
      <form action="{{route('admin.store.schedule')}}" method="POST" enctype="multipart/form-data" class=" row-span-4">
      @csrf

      <div class="relative h-full  overflow-y-hidden overflow-x-hidden ">
        <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide" >
          
            <div class="grid grid-rows-7 gap-1 w-full ">  

                <div class="flex md:flex-row flex-col px-4 content-center text-left ">
                <div class="flex-initial">       
                  <span class="text-gray-700 text-lg  mr-5">Choose Schedule</span>
              </div>
              <div class="flex-auto">
                <!-- <input type="month" name="month" class="month-select border py-2 px-3 rounded-lg w-full text-lg"> -->
                <select class="form-select w-full month-select text-lg" onchange="get_date()" name="month" >
                  @foreach($months as $month)
                    <option @if(($start_date->format('Y-m') == $month->format('Y-m'))) selected @endif value="{{$month->format('Y-m')}}">{{$month->format('F Y')}}</option>
                  @endforeach
                </select>
            </div>   
        </div>
         

            <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
               <div id="div1" class=" duration-1000 targetDiv bg-gray-50 justify-content content-center text-center rounded-lg pt-4"> 
                  <h1 id="date-month" class=" text-center"></h1>
                  <div id="showresults">
                    @for($i = 1; $i <= $start_date->daysInMonth; $i++, $start_date->addDay())
                      @php
                        $schedule = \App\Models\ScheduleMenu::where('date',$start_date->format('Y-m-d'))->first();
                      @endphp
                      <label class='label flex-auto contents duration-1000'>
                        <input class='label__checkbox duration-1000' type='checkbox' value="{{$start_date->format('Y-m-d')}}" name='dates[]' >
                        <span class='label__text '>
                          <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient(@if($schedule == null) 160deg, #0093E9 0%, #80D0C7 100% @else 135deg, #FCCF31 10%, #F55555 100% @endif);'>
                            <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>
                              <div class='font-semibold text-4xl mb-2 '>{{$start_date->format('d')}}</div>
                              <div class='text-xs font-base'>{{$start_date->format('l')}}</div>
                            </i>
                          </span>
                        </span>
                      </label>
                    @endfor  
                  </div>
              </div>
          </div>

            <div class="text-xl row-span-1 text-right pointer px-6 ">
               <a onclick="nextSlide()" id="btn-slide-dis-2y" class="cursor-pointer bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200"> Next  <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
          </div>
        </div>
  
        <div class="absolute inset-0 w-full h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

          <div class="grid grid-rows-7 md:grid-cols-4 grid-cols-1 gap-1 w-full overflow-y-auto">  

           <h3 class="flex-shrink min-w-0 font-regular text-2xl leading-snug truncate text-center mb-6 h-15 col-span-4">
             Select Your Menu
           </h3>
         

           <ul id="myUL" class="block md:contents">   
            @foreach($menus as $menu) 
            <li>
              <input type="checkbox" id="{{$menu->id}}" name="menus[]" value="{{$menu->id}}" class="schedule-menu hidden" >
              <label for="{{$menu->id}}">
                <div class="flex flex-col text-center mb-6 gap-2 border-2 border-gray-700 border-opacity-25 h-auto top-0 w-full mx-auto check-resize bg-gray-700 p-3 rounded-xl hover:shadow-xl hover:border-orange-400 duration-500">
                  <div>
                    <span>  
                      <div class="  text-xl font-semibold text-white capitalize mt-3 absolute px-1 py-1 bg-gray-700 rounded-r-lg truncate w-3/4">{{$menu->name}}             
                      </div>
                    </span>
                    <img src="{{url('public/'.$menu->photos->random()->file)}}" alt="" class="rounded-xl  object-cover w-full h-44">
                  </div>
                  <div class=" text-base font-bold text-gray-400 text-left px-3 ">Description :</div>
                  <div class=" text-base font-base text-gray-400 text-left px-3  ">{{$menu->desc}}</div>  
                  <div class=" text-base font-semibold text-purple-400 text-right px-3">From : {{$menu->catering->name}}</div> 
                </div>           
              </label>
            </li>
            @endforeach
           
          
          </ul>
          <div class=" text-xl col-span-4 text-left pointer px-6 pt-6">
           <button onclick="previousSlide()" id="btn-slide-disy" class="ml-2 bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-none"><i class="fas fa-arrow-left"></i> Back</button>
            <button type="submit" name="submit" id="btn-slide-disy" class="float-right ml-2 bg-blue-500 px-6 py-2 rounded-lg  text-white opacity-75 bottom-6 hover:bg-blue-600 text-xl duration-1000 focus:border-none right-10">Save Schedule</button>
         </div>
          </form>
         
       </div>
      
    
   </div>

           
      </div>
    </div>
  </div>
</div>

<script src="{{asset('resources/js/myJs.js')}}"></script>
</x-app-layout>

<script type="text/javascript">

    $('.schedule-menu').on('change', function (e) {
        if($('.schedule-menu:checked').length > 2) {
            $(this).prop('checked', false);
            alert("allowed only 2");
        }
    });
    $('.month-select').change(function() {
        var date = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('admin.get_month_schedule') }}",
            type: "POST",
            data: {month : date},
            success: function(data) {
                if (data == null) {
                    alert('Error get date.');
                }
                else{
                    var input = "";
                    $.each(data, function(d, v){
                        input = input + v;
                    });
                    $("#showresults").html(input);
                }
            }
        });
    });
</script>
