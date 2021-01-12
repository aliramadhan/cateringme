<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Menu') }}
        </h2>
    </x-slot>
      
    <link rel="stylesheet" href="{{asset('resources/css/Foodcheckbox.css')}}" /> 
      <div class="max-w-7xl mx-auto  lg:px-8">
           @if (session('message'))
        <div class="max-w-7xl mx-auto lg:px-8 bg-white border-t-4 rounded-b text-teal-darkest px-4 py-3 shadow-md my-2 " role="alert">
          <div class="flex">
            <svg class="h-6 w-6 text-teal mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
            <div>
              <p class="font-bold"> {{ session('message') }}</p>
              <p class="text-sm">Make sure you know how these changes affect you.</p>
            </div>
          </div>
        </div>  
        @endif
        @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
      </div>
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

    <form action="{{route('admin.scheduled.menu')}}" method="POST" class="contents">
    @csrf
        <input type="text" name="searching" class="focus:ring-red-100 focus:border-red-100 flex-1 block  bg-gray-100 rounded-l rounded-r-md sm:text-sm border-gray-100 py-2 px-4 mr-2 hover:border-blue-200 w-36 md:w-full" placeholder="Search" id="searching shadow-xl" onkeyup="searchingEmployee()" >
         <button type="submit" name="submit" id="btn-slide-dis-2y" class="bg-blue-500  rounded-lg text-white pr-4 duration-1000 hover:bg-blue-700 duration-1000 shadow-2xl  bottom-20 mx-auto "><i class="fas fa-save mr-2 bg-blue-700 p-3 rounded-l-lg"></i> Save</button>
    </div>
</div>

<div class="relative md:h-screen h-full">
   
    <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto  bg-gray-100" >      

      <div class="grid grid-flow-row md:grid-cols-3 grid-cols-2 gap-2 w-full text-center mt-6 h-max"   style="height: fit-content;">      

        <ul id="myUL" class="contents">         
            <?php $a=1;?>
          @foreach($menus as $menu)
          <li>

             <input type="checkbox" id="myCheckbox{{$a}}" class="schedule-menu" name="show[]" value="{{$menu->menu_code}}" @if($menu->show == 1) checked @endif>
             <label for="myCheckbox{{$a++}}">
            
                <div class="flex flex-col text-center mb-6 gap-2 border-2 border-opacity-25 h-auto top-0 w-full mx-auto check-resize bg-white p-3 rounded-xl hover:shadow-xl hover:border-orange-400 duration-500">

                    <div>
                    <span>  
                        <div class=" text-xl font-semibold text-orange-600 mt-3 absolute  px-4 py-1 bg-white rounded-r-lg">{{$menu->name}}                         

                            </div>
                        </span>
                        <img src="{{url('public/'.$menu->photos->first()->file)}}" alt="{{ $menu->name }}" class="rounded-xl  object-cover h-44">

                    </div>
                    <div class=" text-base font-bold text-gray-600 text-left px-3 ">Description</div>
                    <div class=" text-base font-base text-gray-600 text-left px-3  ">{{$menu->desc}}</div>  
                    <div class=" text-base font-semibold text-purple-600 text-right px-3">From : {{$menu->catering->name}}</div> 

                </div>           
            </label>
        </li>
        @endforeach
        </form>
        @csrf
    </ul>
</div>    
</div>





</div>


</div>
</div>



</div>
<script src="{{asset('resources/js/myJs.js')}}"></script>
<script src="{{asset('resources/js/searching.js')}}"></script>
</x-app-layout>
<script type="text/javascript">
    $('.schedule-menu').on('change', function (e) {
        if($('.schedule-menu:checked').length > 2) {
            $(this).prop('checked', false);
            alert("allowed only 2");
        }
    });
</script>
