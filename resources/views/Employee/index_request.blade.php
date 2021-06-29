<x-app-layout>
   <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index Request') }}
        </h2>
    </x-slot>

<form action="{{route('employee.create.request')}}" method="POST">
@csrf
  <input type="text" name="desc">
  <input type="submit" name="submit">
</form>

 <div class="py-12">
        <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
            <div class="flex-shrink min-w-0 flex items-center">
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
               Index your Request in Catering App
             </h3>
           </div>
          
           <div class="ml-4 flex items-center gap-4 lg:w-4/12 md:w-5/12 w-full">

            
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
            data-export-options='{"fileName": "History Review {{Carbon\Carbon::now()->subMonth()->format('F Y')}}"}'>

            <thead class="text-gray-600 capitalize font-semibold text-base font-semibold rounded-xl bg-gray-100" style="
            background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
            ">
            <th class="w-12">No.</th>        
             <th>Date</th>
             <th>Type</th>
             <th>Desc</th>
             <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-center bg-white py-4" >
      @foreach($requests as $request)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$request->date}}</td>
          <td>{{$request->type}}</td>
          <td>{{$request->desc}}</td>
        </tr>
      @endforeach
    </tbody>
</table>

</div>
</div>
</div></div>

</x-app-layout>
