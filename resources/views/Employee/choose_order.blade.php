<x-app-layout>
   <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>
   <link rel="stylesheet" href="{{ asset('resources/css/date.css') }}">
   <style type="text/css">
     .overlay {
      position: absolute;
      bottom: 100%;
      left: 0;
      right: 0;
      background-color: #008CBA;
      overflow: hidden;
      width: 100%;
      height:0;
      transition: .5s ease;
    }

    .container:hover .overlay {
      bottom: 0;
      height: 100%;
    }
   </style>


    <div id="success" class="invisible absolute"></div>
     <div id="failure" class="invisible absolute"></div>
    
        @if (session('message'))
          <script type="text/javascript">
            window.onload = function(){
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
            window.onload = function(){
            document.getElementById('failure').click();
            var scriptTag = document.createElement("script");        
            document.getElementsByTagName("head")[0].appendChild(scriptTag);
          }          
        </script>
          <style type="text/css">  .success:before{
            Content:"  {{ implode('', $errors->all('<div>:message</div>')) }}";
          }</style>
         
          @endif

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('
        Catering Schedule Formating') }}
    </h2>
</x-slot>

<div class="py-12">
  <div class="max-w-7xl mx-auto lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
      <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
        <div class="flex-shrink min-w-0 flex items-center">
          <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
            Selection of dates for catering
          </h3>
        </div>
        <div class="ml-4 flex flex-shrink-0 items-center">
          <div class="flex items-center text-sm sm:hidden">
            <button type="button" onclick="previousSlide()" id="btn-slide-dis" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
              <i class="fas fa-calendar-week"></i>
            </button>
            <button type="button" onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
              <i class="fas fa-utensils"></i>
            </button>
          </div>
          <div class="hidden sm:flex items-center text-sm md:text-base">
            <button type="button" id="btn-slide-disx" onclick="previousSlide()"   class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600 ">
              Schedule
            </button>
            <button type="button" id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
              Food Menu
            </button>

          </div>
          <div class="hidden sm:flex sm:items-center">
            <div class="pl-4 pr-4 self-stretch">
            <div class="h-full border-l border-gray-200"></div>
            </div>
            <button type="button" @click="$refs[`${activeSnippet}ClipboardCode`].select(); document.execCommand('copy')" class="ml-3 text-gray-400 hover:text-gray-500" >
            <i class="fas fa-calendar-week"></i>
            </button>
          </div>
        </div>
      </div>

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
                  <option>Select Month</option>
                  @foreach($months as $month)
                    <option value="{{$month->format('Y-m')}}">{{$month->format('F Y')}}</option>
                  @endforeach
                </select>
            </div>   
        </div>
         
            <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data" class=" row-span-4">
            @csrf

            <div class="flex-row gap-2 px-4 mb-8">                       

              <div id="div1" class=" duration-1000 targetDiv bg-gray-50 justify-content content-center text-center rounded-lg"> 
                  <h1 id="date-month" class="mb-4 text-center mt-8"></h1>
                  <div id="dates-list" >
                    @for($i = 1; $i <= $total_date; $i++, $start->addDay())
                    @php
                      $order = \App\Models\Order::where('employee_id',$user->id)->where('order_date',$start->format('Y-m-d'))->first();
                    @endphp
                    <label class='label flex-auto  duration-1000'>
                        <input class='label__checkbox  duration-1000' @if(in_array($start->day, $off_date) || $start < Carbon\Carbon::now()) disabled  @endif type='checkbox' value="{{$now->format('Y-m-d')}}" name='dates[]'>
                        <span class='label__text '>
                          <span class='label__check rounded-lg text-white  duration-1000 text-justify' style="@if(in_array($start->day, $off_date)) background: linear-gradient(to right, #ff416c, #ff4b2b); @elseif($order != null) background-image: linear-gradient( 135deg, #FCCF31 10%, #F55555 100%); @elseif($start < Carbon\Carbon::now()) background-image: linear-gradient(160deg, #bdbdbe 0%, #032a32 100%); @else background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%); @endif" >
                            <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 duration-1000 p-10' style='font-family: Poppins, sans-serif;'>
                         
                              <div class='font-semibold text-4xl'>{{$now->format('d')}}</div>
                              <div class='text-xs font-base'>{{$now->format('l')}}</div>
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

          <div class="flex flex-col  ">
            <h3 class="flex-shrink min-w-0 font-regular text-2xl leading-snug truncate text-center mt-2">
             Select Your Menu
            </h3>

            <div class="grid grid-cols-2 row-span-2 md:row-span-1 gap-12 w-full p-8">
              
              @foreach($menus as $menu)
              <div class=" text-2xl col-span-2 md:col-span-1">
                <button type="submit" class="hover:opacity-100 opacity-75 duration-500 transition w-full ease-in-out rounded-xl" name="menu" value="{{$menu->menu_code}}">
               <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-xl rounded-lg @if($loop->iteration == 1) bg-pink-600 @else bg-blue-600 @endif"><img alt="..." src="{{url('public/'.$menu->photos->random()->file)}}" class="w-full align-middle h-64 rounded-t-lg object-cover"><blockquote class="relative p-8 mb-4"><svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height:95px;top:-94px"><polygon points="-30,95 583,95 583,65" class="@if($loop->iteration == 1) text-pink-600 @else text-blue-600 @endif fill-current"></polygon></svg><h4 class="text-3xl font-bold text-white">{{$menu->name}}</h4><p class="text-md font-light mt-2 text-white overflow-ellipsis overflow-hidden h-32 leading-none">{{$menu->desc}}  
                <br>
                @for($i = 1; $i <= $menu->rate; $i++) <i class="fas fa-star"></i> @endfor
                    </p></blockquote></div>
                </button>
              </div>

              @endforeach
              </form>
            </div>

            <div class=" text-xl row-span-1 text-left pointer px-6">
               <button  onclick="previousSlide()" id="btn-slide-disy" class="ml-2 bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-none><i class="fas fa-arrow-left"></i> Back</button>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('resources/js/myJs.js')}}"></script>
</x-app-layout>
<script type="text/javascript">
  function get_date(){
    var month = $('select.month-select').children("option:selected").val();
    console.log(month);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('employee.get_date') }}",
            type: "POST",
            data: {month : month},
            success: function(data) {
                console.log(data);
                var month = data.month;
                if (data == null) {
                    alert('Error get date.');
                }
                else{
                    var input = "";
                    $.each(data.dates, function(d, v){
                        input = input + v;
                    });
                    $("#dates-list").html(input);
                    $("#date-month").html(month);
                }
            }
        });
  }
</script>
