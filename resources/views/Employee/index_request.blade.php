<x-app-layout>
   <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
    <x-slot name="header" >
      <div class="text-left flex justify-between items-start md:items-center flex-col md:flex-row space-y-2">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Order Activation Request') }}
        </h2>
        <button type="button" class="bg-blue-500 text-white py-2 px-6 rounded-xl opacity-75 hover:opacity-100 duration-200 modal-open text-base shadow-2xl w-full md:w-auto" data-toggle="modal" data-target="reviewModal"><i class="fas fa-feather-alt mr-2"></i>Send Request</button>
      </div>
    </x-slot>


<form action="{{route('employee.create.request')}}" method="POST">
@csrf
    <div class="modal z-20 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center" id="reviewModal">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
          <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
          <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center border-b pb-3">
            <p class="text-2xl font-bold text-gray-600">Form Allowed <font class="text-orange-500">Order Request</font></p>
            <div class="modal-close cursor-pointer z-50">
              <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
              </svg>
            </div>
          </div>

          <!--Body-->
          <div class="flex flex-wrap mt-6">
            <div class="relative w-full appearance-none label-floating">
              <p class="text-xl font-base text-gray-600 ">Reason</p>
              <textarea required name="desc" class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-50 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 h-52"
              id="message" type="text" placeholder="Message..."></textarea>
              <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Write your Reason
              </label>
            </div>
          </div>            
          <!--Footer-->
          <div class="flex justify-end pt-2">

            <button type="submit" name="submit" class=" px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Send</button>
          </div>

        </div>
      </div>
    </div>
</form>

 <div class="py-12">
        <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="px-4 py-2 border-b border-gray-200 bg-white sm:py-4 sm:px-6 sm:items-baseline">
            
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
               History of your catering order activation request
             </h3>
           
          
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
             <th  data-sortable="true">Date</th>
             <th>Type</th>
             <th>Reason</th>
             <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-center bg-white py-4" >
      @foreach($requests as $request)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{date('D, d M Y', strtotime($request->date))}}</td>
          <td>{{$request->type}}</td>
          <td>{{$request->desc}}</td>
          <td>
            @if($request->status != 'Waiting')
                <form method="POST" action="{{route('employee.destroy.request',['id' => $request->id])}}">
                @csrf
                @method('DELETE')
                    <input type="submit" name="submit" class="btn btn-danger rounded-lg" value="Delete" onclick="return confirm('Delete this request?');">
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
