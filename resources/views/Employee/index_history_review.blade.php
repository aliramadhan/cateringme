<x-app-layout>
   <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History Review Order') }}
        </h2>
    </x-slot>


 <div class="py-12">
        <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
            <div class="flex-shrink min-w-0 flex items-center">
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
               History Your Review and Feed
             </h3>
           </div>
          
           <div class="ml-4 flex items-center gap-4 md:w-4/12 w-full">
            <form class="contents">
              @csrf
              <input type="month" name="month" min="2020-12" max="{{$now->format('Y-m')}}" class="w-5/6 md:w-full text border px-3 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-30 mr-2">
              <button type="submit" name="submit" class="py-2 px-3 rounded-lg transition-500 bg-blue-400 hover:bg-blue-500 focus:outline-none text-white"> <i class="fas fa-search"></i></button>

            </form>

            
        </div>
                   
       
      </div>
         <div class="relative md:h-screen h-full">
              <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto bg-gray-100" >      

            <div class="bootstrapiso w-full bg-transparent ">
            <table class="w-fulltable min-w-full divide-y divide-gray-200 text-gray-600 text-center rounded-lg table-striped text-lg table-borderless " 
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
            data-export-types= "['excel','doc', 'txt']"
            data-export-options='{"fileName": "History My Review"}'>

            <thead class="text-gray-600 capitalize font-semibold text-base font-semibold rounded-xl bg-gray-100" style="
            background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
            ">
            <th class="w-12">No.</th>           
            <th>Menu</th>
            <th>Stars</th>
            <th>Review</th>
             <th>Date</th>
        </tr>
    </thead>
    <tbody class="text-center bg-white py-4" >
     @for($i = 1, $start->subMonth(); $i <= $now->daysInMonth; $i++, $start->addDay())
     @php
     $review = auth()->user()->orders->where('review_at',$start->format('Y-m-d'))->first();
     if($review == null){
     continue;
   }
   @endphp
   <tr>
    <td>{{$i}}</td>   
    <td>@if($review != null) {{$review->menu_name}} @endif</td>
    <td>{{$review->stars}}</td>
    <td>{{$review->review}}</td>
    <td>{{$start->format('d, M Y')}}</td>
  </tr>
  @endfor  
</tbody>
</table>

</div>
</div>
</div></div>

</x-app-layout>
