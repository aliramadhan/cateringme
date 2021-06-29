<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }} <span class="font-normal text-lg">{{ __('/ Request ') }}</span>
        </h2>
    </x-slot>
      
    <div class="py-12">
        <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 px-4 sm:items-baseline">
            <div class="flex-shrink min-w-0 flex items-center">
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate capitalize">
                please select the reporting period you want
             </h3>
           </div>
           <div class="md:ml-4 flex items-center gap-4 lg:w-7/12  md:w-8/12 w-full">
              <form action="#" method="GET" class="contents">
            @csrf
            <input type="date" class="md:w-full w-4/12 text border px-3 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-30" @if($from != null) value="{{$from->format('Y-m-d')}}" @endif name="from" class="p-4">
             To 
            <input type="date" class="md:w-full w-4/12 text border px-3 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-30" @if($to != null) value="{{$to->format('Y-m-d')}}" @endif name="to">
             <button type="submit" name="submit" class="py-2 px-3 rounded-lg transition-500 bg-blue-400 hover:bg-blue-500 focus:outline-none text-white"> <i class="fas fa-search"></i></button>
         </form>
         
        </div>
      </div>
         <div class="relative h-full">
              <div class=" inset-0 w-full h-full text-gray-600 flex text-5xl p-3 md:p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto bg-white" >      

            <div class="bootstrapiso w-full bg-transparent text-base ">
            <div class="lg:absolute text-xl font-semibold top-9 md:text-left text-center"><span class="text-gray-500 font-base">Period:</span>  @if($from == null) All time @else {{$from->format('d F Y')}} - {{$to->format('d F Y')}} @endif </div>
            <table class="w-fulltable min-w-full divide-y divide-gray-200 text-gray-600 text-center rounded-lg table-striped table-borderless table-exp-cus" 
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
            data-export-options='{"fileName": "Review | @if($from == null) All time @else {{$from->format('d F Y')}} - {{$to->format('d F Y')}} @endif "}'
            >

            <thead class="text-gray-600 uppercase font-semibold text-lg font-semibold rounded-lg bg-gray-100" style="
            background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
            ">           
            <tr>
                <th>No.</th>
                <th>Employee Name</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Requested at</th>
                <th>Action</th>
        </tr>

    </thead>
    <tbody class="text-center bg-white py-4" >       

            @foreach($requests as $request)
            @php
                $user = App\Models\User::find($request->employee_id);
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$request->employee_name}}</td>
                <td>{{date('D, d M Y', strtotime($request->date))}}</td>
                <td>{{$request->desc}}</td>
                <td>{{Carbon\Carbon::parse($request->created_at)->format('H:s, d, M Y')}}</td>
                <td>
                    @if($user->can_order_directly)
                        <form method="POST" action="{{route('admin.deactivated.order.direct',['id' => $user->id])}}">
                        @csrf
                            <input type="submit" name="submit" class="btn btn-danger rounded-lg" value="Deactivated" onclick="return confirm('Deactivated feature direct order {{$user->name}}');">
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
    </tbody>
</table>

</div>
</div>
</div></div>

</x-app-layout>