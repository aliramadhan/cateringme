<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menu Today') }}
        </h2>
    </x-slot>
     <link rel="stylesheet" href="{{asset('resources/css/Foodcheckbox.css')}}" />
     <div class="py-12">

      <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
            <div class="flex-shrink min-w-0 flex items-center">
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
               Catering Order
             </h3>
           </div>
           <div class="ml-4 flex flex-shrink-0 items-center">

            <input type="text" name="searching" class="focus:ring-red-100 focus:border-red-100 flex-1 block md:w-full  w-24 bg-gray-100 rounded-l rounded-r-md sm:text-sm border-gray-100 py-2 px-4 mr-2 hover:border-blue-200 " placeholder="Search" id="searching" onkeyup="searchingEmployee()" >

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

          <div class="flex items-center md:block hidden">
            <div class="pl-4 pr-4 self-stretch">
              <div class="h-full border-l border-gray-200"></div>
            </div>
              <button type="submit" name="submit" id="btn-slide-dis-2y" class="bg-blue-500  rounded-lg text-white pr-4 duration-1000 hover:bg-blue-700 duration-1000 shadow-2xl bottom-20 mx-auto ">
                <i class="fas fa-save mr-2 bg-blue-700 p-3 rounded-l-lg"></i> Save</button>
          </div>

           <div class="flex items-center sm:hidden ">
            <div class="pl-4 pr-4 self-stretch">
              <div class="h-full border-l border-gray-200"></div>
            </div>
              <button type="submit" name="submit" id="btn-slide-dis-2y" class="bg-blue-500  rounded-lg text-white duration-1000 hover:bg-blue-700 duration-1000 shadow-2xl bottom-20 mx-auto ">
                <i class="fas fa-save p-3 "></i></button>
          </div>
        </div>
      </div>

      <div class="relative md:h-screen h-full">
        <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-1 md:p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto bg-gray-100" >      


          <div class="grid grid-flow-row md:grid-cols-4 grid-cols-2 md:gap-4  items-center text-center h-max mx-auto w-full" style="height: fit-content;">      

            <ul id="myUL" class="contents">         
             <?php $a=1;?>
             @foreach($orders as $order)
            <li>
                <input type="checkbox" id="myCheckbox{{$a}}" class="schedule-menu" >
             <label for="myCheckbox{{$a++}}">
                 <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden transform hover:-translate-y-2 hover:shadow-2xl duration-500 cursor-pointer">
                            
                            <div class="px-3 text-center pt-4 pb-52 relative z-10 bg-gradient-to-b from-gray-900 to-transparent ">
                                <h4 class="font-semibold text-xl text-white ">{{$order->menu->name}}</h4>
                                
                            </div>
                            <div class="absolute bottom-0 inset-x-0">
                               <img src="{{url('public/'.$order->menu->photos->random()->file)}}" class="object-cover h-full">
                            </div>

                            <div class="flex flex-col md:flex-row text-base bg-white py-2 z-10 bottom-0 absolute rounded-br-xl text-gray-600 px-1 md:px-4 hover:bg-gray-900 hover:text-white duration-500 cursor-pointer flex items-center w-full">

                                   
                                     <img src="{{ $order->employee->profile_photo_url }}" class="object-cover h-10 w-10 rounded-full">
                                     <div class="ml-2 text-left">
                                        <a href="#" class=" font-semibold ">{{$order->employee->name}}</a>
                                        <div class=" text-sm font-semibold text-indigo-700 -mt-1 truncate">
                                          {{$order->employee->role}}
                                      </div>
                                    </div>
                                 

                              
                            </div>
                        </div>
                    </div> 
                </label>
            </li>

            @endforeach
        
      </ul>
    </div>
    

  </div>

  <div class="absolute inset-0 w-full h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

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
    
    <thead class="bg-gray-800 text-white uppercase font-semibold text-sm ">
        <tr>
          <th>No.</th>
          <th>Employee Name</th>
          <th>Employee Role</th>
          <th>Menu</th>
      </tr>
  </thead>
  <tbody class="text-center">   
    @foreach($orders as $order)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$order->employee->name}}</td>
       <td>{{$order->employee->role}}</td>
      <td>{{$order->menu->name}}</td>
  </tr>
    @endforeach
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