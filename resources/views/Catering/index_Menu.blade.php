<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Catering Menu') }}
        </h2>
    </x-slot>
    <div id="success" class="invisible absolute"></div>
       <div id="failure" class="invisible absolute"></div>
      
          @if(session('message'))
            <script type="text/javascript">
              function notifu(){
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
              function notifu(){
              document.getElementById('failure').click();
              var scriptTag = document.createElement("script");        
              document.getElementsByTagName("head")[0].appendChild(scriptTag);
            }          
          </script>
            <style type="text/css">  .failure:before{
              Content:"  {{ implode('', $errors->all(':message')) }}";
            }</style>
           
          @endif  

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50" id="modalAdd">
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
      <div class="flex justify-between items-center pb-3">
        <p class="text-2xl font-bold text-gray-600 mb-4">Add Catering Menu</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
    </div>
</div>

<!--Body-->

<form method="POST" action="{{ route('catering.store.menu') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <x-jet-label for="name" value="{{ __('Menu Name') }}" />
        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
    </div>

    <div class="mt-4">
        <x-jet-label for="photo" value="{{ __('Photo') }}" />
        <x-jet-input id="photo" class="block mt-1 w-full overflow-hidden" type="file" accept="image/x-png,image/gif,image/jpeg" name="photo[]" :value="old('photo')" required multiple />
    </div>
    <div class="mt-4">
        <x-jet-label for="address" value="{{ __('Description') }}" />
        <textarea class="form-textarea block mt-1 w-full" name="desc">{{old('desc')}}</textarea>
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-jet-button class="ml-4">
            {{ __('Submit') }}
        </x-jet-button>
    </div>
</form>
</div>
</div>
</div>


<div class="py-12">

  <div class="max-w-7xl mx-auto  lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
      <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
        <div class="flex-shrink min-w-0 flex items-center">
          <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
             Food Menu Data
         </h3>
     </div>
     <div class="ml-4 flex flex-shrink-0 items-center">

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

  <div class="flex items-center">
    <div class="pl-4 pr-4 self-stretch hidden md:block">
      <div class="h-full border-l border-gray-200"></div>
  </div>


  <button type="button" class="ml-1 px-2 rounded-lg opacity-75 hover:opacity-100  bg-gradient-to-r from-blue-400 via-blue-500 duration-500  to-indigo-500 text-white font-medium text-2xl modal-open focus:border-none" data-toggle="modal" data-target="modalAdd">
     +</button> 
  
</div>
</div>
</div>

<div class="relative md:h-screen h-full">
    <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto" >      

      <div class="grid grid-flow-row lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-4 w-full text-center mt-6 h-max"   >      

        <ul id="myUL" class="contents">         
          @foreach($menus as $menu)
           <li>
              <a href="{{route('catering.edit.menu',$menu->menu_code)}}">
                <div class="flex flex-col text-center mb-6 gap-2 border-2 border-opacity-25 h-auto top-0 w-full mx-auto check-resize bg-white p-3 rounded-xl hover:shadow-xl hover:border-orange-400 duration-500 ">
                   <div >
                    <span>  
                        <div class=" text-xl font-semibold text-orange-600 mt-3 absolute  px-4 py-1 bg-white rounded-r-lg">{{$menu->name}}</div>
                    </span>
                    <img src="@if($menu->photos->first() != null) {{url('public/'.$menu->photos->first()->file)}} @else {{url('public/images/no-image.png')}} @endif" alt="{{ $menu->name }}" class="h-52 rounded-xl object-cover w-full">

                  </div>
                  <div class=" text-base font-bold text-gray-600 text-left px-2">Description</div>
                  <div class=" text-base font-base text-gray-600 text-left px-2">{{$menu->desc}}</div>     
                  <div class=" text-base font-base text-orange-500 text-right px-2">@for($i = 1; $i <= $menu->rate; $i++) <i class="fas fa-star"></i> @endfor</div>     

              </div>
          </a>
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

    <thead class="bg-gray-800 text-white uppercase font-semibold text-base font-semibold ">
       <th>No.</th>
       <th data-visible="false">Photo</th>
       <th>Name</th>
       <th class="overflow-hidden">Deskripsi</th>
   </tr>
</thead>
<tbody class="text-center font-semibold tracking-wider">  
    @foreach($menus as $menu)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td><img class="object-none h-48 w-full" src="@if($menu->photos->first() != null) {{url('public/'.$menu->photos->first()->file)}} @else {{url('public/images/no-image.png')}} @endif"></td>
        <td>{{$menu->name}}</td>
        <td>{{$menu->desc}}</td>
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