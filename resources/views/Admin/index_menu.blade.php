<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Account') }}
        </h2>
    </x-slot>

    @if (session('message'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <link rel="stylesheet" href="{{asset('resources/css/Foodcheckbox.css')}}" /> 
    
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

    <form action="{{route('admin.scheduled.menu')}}" method="POST" class="contents">

        <input type="text" name="searching" class="focus:ring-red-100 focus:border-red-100 flex-1 block  bg-gray-100 rounded-l rounded-r-md sm:text-sm border-gray-100 py-2 px-4 mr-2 hover:border-blue-200 w-36 md:w-full" placeholder="Search" id="searching shadow-xl" onkeyup="searchingEmployee()" >
         <button type="submit" name="submit" id="btn-slide-dis-2y" class="bg-blue-500 px-4 py-2 rounded-lg text-white  duration-1000 hover:bg-blue-700 duration-1000 shadow-2xl  bottom-20 mx-auto "><i class="fas fa-save mr-2"></i> Save</button>
    </div>
</div>

<div class="relative md:h-screen h-full">
   
    <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto" >      

      <div class="grid grid-flow-row md:grid-cols-3 grid-cols-2 gap-6 w-full items-center text-center mt-10 h-max"   style="height: fit-content;">      

        <ul id="myUL" class="contents">         
            <?php $a=1;?>
          @foreach($menus as $menu)
          <li>

             <input type="checkbox" id="myCheckbox{{$a}}" class="schedule-menu" name="show[]" value="{{$menu->menu_code}}" @if($menu->show == 1) checked @endif>
             <label for="myCheckbox{{$a++}}">
            
                <div class="flex flex-col text-center mb-6 gap-2 h-80  w-full mx-auto check-resize  pb-2 rounded-b-xl">

                    <div>
                    <span>  
                        <div class=" text-xl font-semibold text-orange-600 mt-3 absolute  px-4 py-1 bg-white rounded-r-lg">{{$menu->name}}                         

                            </div>
                        </span>
                        <img src="{{url('public/'.$menu->photos->first()->file)}}" alt="{{ $menu->name }}" class="rounded-xl  object-cover ">

                    </div>
                    <div class=" text-base font-bold text-gray-600 text-left px-3 ">Description</div>
                    <div class=" text-base font-base text-gray-600 text-left px-3  ">{{$menu->desc}}</div>  
                    <div class=" text-base font-semibold text-purple-600 text-right px-3">From : {{$menu->catering->name}}</div> 

                </div>           
            </label>
        </li>
        @endforeach
        </form>
    </ul>
</div>    
</div>





</div>


</div>
</div>



</div>
<script src="{{asset('resources/js/myJs.js')}}"></script>
<script src="{{asset('resources/js/searching.js')}}"></script>


<!-- <div class="py-12">
    <form action="{{route('admin.scheduled.menu')}}" method="POST">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-auto w-full mx-auto">
                    <thead>
                        <tr class="bg-blue-200">
                            <th>No.</th>
                            <th>Name</th>
                            <th>Catering</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($menus as $menu)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$menu->name}}</td>
                            <td>{{$menu->catering->name}}</td>
                            <td><input class="schedule-menu" type="checkbox" name="show[]" value="{{$menu->menu_code}}" @if($menu->show == 1) checked @endif></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <input type="submit" name="submit">
    </form>
</div> -->
</x-app-layout>
<script type="text/javascript">
    $('.schedule-menu').on('change', function (e) {
        if($('.schedule-menu:checked').length > 2) {
            $(this).prop('checked', false);
            alert("allowed only 2");
        }
    });
</script>
