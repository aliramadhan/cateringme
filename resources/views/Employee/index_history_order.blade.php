<x-app-layout>
   <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History Catering Order') }}
        </h2>
    </x-slot>
<style type="text/css">
  .pagination-info{
    color: #fff;
  }
</style>

<div class="py-12">

  <div class="max-w-7xl mx-auto  lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
      <div class="px-4 py-2 border-b border-gray-200 flex md:flex-row flex-col gap-4 justify-between md:items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
        <div class=" min-w-0 flex items-center">

        <form class="contents">
        @csrf
        <input type="month" name="month" min="2020-12" max="{{$now->format('Y-m')}}" class="w-5/6 md:w-full text border px-3 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-30 mr-2" value="{{$start->format('Y-m')}}">
        <button type="submit" name="submit" class="py-2 px-3 rounded-lg transition-500 bg-blue-400 hover:bg-blue-500 focus:outline-none text-white"> <i class="fas fa-search"></i></button>
          
        </form>

     </div>
     <div class="flex flex-shrink-0 items-center">

        <input type="text" name="searching" class="focus:ring-red-100 focus:border-red-100 flex-1 block  bg-gray-100 rounded-l rounded-r-md sm:text-sm border-gray-100 py-2 px-4 mr-2 hover:border-blue-200 w-36 md:w-full" placeholder="Search" id="searching" onkeyup="searchingEmployee()" >

        <div class="flex items-center text-sm sm:hidden">
          <button type="button" onclick="previousSlide()" id="btn-slide-dis" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
             <i class="fas fa-th"></i>
         </button>
         <button type="button" onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
             <i class="fas fa-table"></i>
         </button>
     </div>

     <div class="hidden sm:flex items-center text-sm md:text-base">
        <button type="button" id="btn-slide-disx" onclick="previousSlide()"   class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600 ">
          Grid
      </button>
      <button type="button" id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
          Tables
      </button>
  </div>

 
</div>
</div>

<div class="relative md:h-screen h-full">
    <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto" >      

      <div class="grid grid-flow-row md:grid-cols-3 grid-cols-1 gap-6 w-full text-center mt-6 h-max"   style="height: fit-content;">      
         <h3 class="col-span-3 min-w-0 font-medium text-5xl leading-snug text-center mb-6 md:h-15 h-28">
           {{$start->format('F Y')}}
       </h3> 
        <ul id="myUL" class="col-span-3 md:contents">    
        @for($i = 1; $i <= $total_days; $i++, $start->addDay())
          @php
            $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
            $order = auth()->user()->orders->where('order_date',$start->format('Y-m-d'))->first();
          @endphp
          @if($order != null)
          <li>
            <a href="#">
              <div class="flex flex-col text-center mb-6 gap-2 border border-opacity-25 h-auto top-0 w-full mx-auto check-resize bg-white p-3 rounded-xl hover:shadow-xl hover:border-orange-400 duration-500 ">
               <span>  
                <div class="  text-4xl font-semibold text-white absolute mt-4 px-4 py-1 bg-white rounded-r-lg -ml-3 shadow-md bg-gradient bg-gradient-to-b from-blue-400 to-purple-500">{{$start->day}}</div>
              </span>
              <div>

                <img src="@if($order->menu->photos->first() != null){{url('public/'.$order->menu->photos->first()->file)}} @else {{url('public/images/no-image.png')}} @endif" alt="#" class="h-52 rounded-xl object-cover w-full">

              </div>
              <div class=" text-base font-bold text-gray-600 text-left px-2">{{$order->menu->name}}</div>
              <div class=" text-base font-base text-gray-600 text-left px-2">{{$order->menu->desc}}</div>     
              <div class=" text-base font-base text-orange-500 text-right px-2">@for($k = 1; $k <= $order->menu->orders->avg('stars'); $k++) <i class="fas fa-star"></i>@endfor </div>     
              </div>
            </a>
          </li>
          @elseif($schedule == null)
          <li>
            <a href="#">
              <div class="flex flex-col text-center mb-6 gap-2 border border-opacity-25 h-auto top-0 w-full mx-auto check-resize bg-white p-3 rounded-xl hover:shadow-xl hover:border-orange-400 duration-500 ">
               <span>  
                <div class="  text-4xl font-semibold text-white absolute mt-4 px-4 py-1 bg-white rounded-r-lg -ml-3 shadow-md bg-gradient bg-gradient-to-b from-red-400 to-orange-500">{{$start->day}}</div>
              </span>
              <div style="background-image:url(https://assets.kompasiana.com/items/album/2018/04/16/suasana-kantor-24slides-indonesia-3-5ad4a44bcaf7db40dd0deff2.jpg?t=o&v=760);" class="rounded-xl bg-cover w-full">
               <div class="h-full md:py-20 md:px-8 p-8 text-white" style="background-image: linear-gradient(0deg,#252525,#27272769) !important;">
                <p class="font-bold text-3xl uppercase mb-2"> Day Off</p>   
                <p class="text-xl font-semibold leading-1 capitalize"> no catering schedule for <br> {{$start->format('d F Y')}} </p>                       
              </div>                 
            </div>



              </div>
            </a>
          </li>
          @else
          <li>
            <a href="{{ route('employee.history.order') }}">
              <div class="flex flex-col text-center mb-6 gap-2 border border-opacity-25 h-auto top-0 w-full mx-auto check-resize bg-white p-3 rounded-xl hover:shadow-xl hover:border-orange-400 duration-500 ">
               <span>  
                <div class="  text-4xl font-semibold text-white absolute mt-4 px-4 py-1 bg-gray-600 rounded-r-lg -ml-3 shadow-md bg-white">{{$start->day}}</div>
              </span>
              <div >
               <div class="h-full md:py-20 md:px-8 p-8 text-gray-600" >
                <p class="font-bold text-3xl uppercase mb-2"> Empty Schedule</p>   
                <p class="text-xl font-semibold leading-1 capitalize">You not take Catering for <br> {{$start->format('d F Y')}} </p>                       
              </div>                 
            </div>
            </div>
          </a>
          </li>
          @endif
        @endfor
    
</div>


</div>

<div class="absolute inset-0 w-full  h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide px-6 overflow-y-auto" >

 <div class="bootstrapiso w-full bg-transparent ">
  <table class="w-full table min-w-full divide-y divide-gray-200 text-white text-center rounded-lg  table-dark table-borderless" 
  id="table"        
  data-locale="en-US"
  data-show-refresh="false"
  data-show-toggle="false"        
  data-show-columns="true"        
  data-show-export="true"
  data-click-to-select="true"
  data-toggle="table"
  data-search="true"
  data-detail-formatter="detailFormatter"
  data-page-list="[10, 25, 50, 100, all]"
  data-show-pagination-switch="false"
  data-pagination="true"
  data-minimum-count-columns="2"
  data-response-handler="responseHandler"
  data-export-types= "['excel','doc', 'txt']">

  <thead class="bg-gray-800 text-white uppercase font-semibold text-base font-semibold ">
    <tr>
      <th class="w-10">No.</th>
      <th>Date</th>
      <th>Menu</th>
      <th>Status</th>
 </tr>
</thead>
<tbody class="text-center font-semibold tracking-wider">
 @for($i = 1, $start->subMonth(); $i <= $now->daysInMonth; $i++, $start->addDay())
 @php
  $schedule = \App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
  $order = auth()->user()->orders->where('order_date',$start->format('Y-m-d'))->first();
 @endphp
 <tr >
  <td>{{$i}}</td>
  <td>{{$start->format('l, d M Y')}}</td>
  <td>@if($order != null) {{$order->menu->name}} @else Empty @endif</td>
  <td>@if($order != null) @if($order->status) 
     <p class="m-0 text-green-400">     
    Served 
    </p>
    @else 
    <p class="m-0 text-orange-400">     
      Waiting
    </p>
    @endif @elseif($schedule == null) 
    <p class="m-0 text-red-500">  
      Day Off 
    </p>
  @else 
  Empty Order 
  @endif
</td>
</tr>
@endfor
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>



</div>
<script src="{{asset('resources/js/myJs.js')}}"></script>
<script src="{{asset('resources/js/searching.js')}}"></script>
</x-app-layout>
