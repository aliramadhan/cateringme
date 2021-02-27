<x-app-layout>

    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Catering') }}
        </h2>
    </x-slot>
 
<style type="text/css">
        .pagination-info{
            color: #2b2f3f;
        }
    </style>


    <div class="py-12">
        <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
            <div class="flex-shrink min-w-0 flex items-center">
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
               Reporting for Catering 
             </h3>
           </div>
           <div class="md:ml-4 flex items-center gap-4 lg:w-7/12  md:w-8/12 w-full">
              <form class="contents">
                @csrf
                <input type="date" class="md:w-full w-4/12 text border px-3 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-30" name="from" class="p-4">

                To 
                <input type="date" class="md:w-full w-4/12 text border px-3 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-30" name="to">
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
            data-export-types= "['excel','doc', 'txt']">

            <thead class="text-gray-600 capitalize font-semibold text-base font-semibold rounded-xl bg-gray-100" style="
            background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
            ">
            <th class="w-12">No</th>
            <th>Menu</th>
            <th>Employee</th>
            <th>Review</th>
            <th>Rates</th>
            <th>Reviewed at</th>
        </tr>
    </thead>
    <tbody class="text-center bg-white py-4" >

       @foreach($reviews as $review)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$review->menu_name}}</td>
                <td>{{$review->employee_name}}</td>
                <td>{{$review->review}}</td>
                <td>{{$review->stars}}</td>
                <td>{{Carbon\Carbon::parse($review->reviewed_at)->format('l F Y')}}</td>
            </tr>
            @endforeach

        
    </tbody>
</table>

</div>
</div>
</div></div>

</x-app-layout>
