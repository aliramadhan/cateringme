<x-app-layout>

    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Catering') }}
        </h2>
    </x-slot>
 <!--    <form action="{{route('catering.index.report')}}" method="GET">
    @csrf
    <input type="month" name="month" @if(request()->month != null) value="{{request()->month}}" @endif>
    <input type="submit" name="submit">
        
    </form> -->
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
           <div class="ml-4 flex flex-shrink-0 items-center gap-4 md:w-4/12 w-full">

              <select class="form-select w-full month-select text-lg" onchange="get_date()" name="month" >
                <option>Select Month</option>                  
                  <option value="Januari">Januari</option>
              </select>
              <select class="form-select w-full month-select text-lg" onchange="get_date()" name="month" >
                  <option>Select Year</option>
                  <option value="2020">2020</option>

              </select>          

         
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
            <th>Rates</th>
            <th>Total Order</th>
            <th>Total Served</th>
        </tr>
    </thead>
    <tbody class="text-center bg-white py-4" >

       @foreach($user->menus as $menu)
            @php
                $qty = $menu->orders->count();
                $start = Carbon\Carbon::parse(request()->month)->startOfMonth();
                $stop = Carbon\Carbon::parse(request()->month)->endOfMonth();
                $now = Carbon\Carbon::now();
                $served = $menu->orders()->where('order_date','<=', $now->format('Y-m-d'))->count();
                if(request()->month != null){
                    $qty = $menu->orders()->whereBetween('order_date',[$start,$stop])->count();
                    if($now < $stop){
                        $served = $menu->orders()->whereBetween('order_date',[$start,$now])->count();
                    }
                    else{
                        $served = $menu->orders()->whereBetween('order_date',[$start,$stop])->count();
                    }
                }
                $menu->rate = $menu->orders()->where('order_date','<=',$now->format('Y-m-d'))->avg('stars');
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$menu->name}}</td>
                <td>({{ $menu->rate}}) @for($i = 1; $i <= $menu->rate; $i++) <i class="fas fa-star text-orange-500"></i> @endfor</td>
                <td>{{$qty}}</td>
                <td>{{$served}}</td>
            </tr>
            @endforeach

        
    </tbody>
</table>

</div>
</div>
</div></div>

</x-app-layout>
