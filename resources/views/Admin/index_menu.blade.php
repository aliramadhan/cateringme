<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Menu') }}
        </h2>
    </x-slot>
      


    <div class="py-12">

      <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
            <div class="flex-shrink min-w-0 flex items-center">
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
              Select Food Menu for Catering
           </h3>
       </div>


       <div class="ml-4 flex flex-shrink-0 items-center">
       

        <input type="text" id="searching2" onkeyup="searchingTwo()"  class="focus:ring-red-100 focus:border-red-100 flex-1 block  bg-gray-100 rounded-l rounded-r-md sm:text-sm border-gray-100 py-2 px-4 mr-2 hover:border-blue-200 w-36 md:w-full " placeholder="Search"> 
    </div>
</div>

<div class="relative md:h-screen h-full">
  <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto  bg-gray-100" >      
    <div class="grid grid-flow-row md:grid-cols-3 grid-cols-2 gap-4 w-full text-center mt-6 h-max"  style="height: fit-content;">      
      <ul id="myUL" class="contents">         
        @foreach($menus as $menu)
        <li>
          <a href="#">
              <div class="flex flex-col text-center mb-6 gap-2 border-2 border-opacity-25 h-auto top-0 w-full mx-auto check-resize bg-white p-3 rounded-xl hover:shadow-xl hover:border-orange-400 duration-500">

                  <div>
                  <span>  
                      <div class=" text-xl font-semibold text-orange-600 mt-3 absolute  px-4 py-1 bg-white rounded-r-lg">{{$menu->name}}                         

                          </div>
                      </span>
                      <img src="@if($menu->photos->first() != null){{url('public/'.$menu->photos->first()->file)}} @else {{url('public/images/no-image.png')}} @endif" alt="{{ $menu->name }}" class="rounded-xl  object-cover w-full h-44"/>

                  </div>
                  <div class=" text-base font-bold text-gray-600 text-left px-3 ">Description</div>
                  <div class=" text-base font-base text-gray-600 text-left px-3  ">{{$menu->desc}}</div>  
                  <div class=" text-base font-semibold text-purple-600 text-right px-3">From : {{$menu->catering->name}}</div> 

              </div>           
            </a>
        </li>
        @endforeach
      </ul>
    </div>    
  </div>
</div>


</div>
</div>


<script src="{{asset('resources/js/searching.js')}}"></script>
</div>


</x-app-layout>
