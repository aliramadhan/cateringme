<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>
   <link rel="stylesheet" href="{{ asset('resources/css/date.css') }}">

@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif
@if (session('message'))
<div class="mb-4 font-medium text-sm text-green-600">
    {{ session('message') }}
</div>
@endif
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('
        Catering Schedule Formating') }}
    </h2>
</x-slot>

<div class="py-12">
  <div class="max-w-7xl mx-auto lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
      <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
        <div class="flex-shrink min-w-0 flex items-center">
          <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
            Selection of dates for catering
          </h3>
        </div>
        <div class="ml-4 flex flex-shrink-0 items-center">
          <div class="flex items-center text-sm sm:hidden">
            <button type="button" onclick="previousSlide()" id="btn-slide-dis" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
              <i class="fas fa-calendar-week"></i>
            </button>
            <button type="button" onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
              <i class="fas fa-utensils"></i>
            </button>
          </div>
          <div class="hidden sm:flex items-center text-sm md:text-base">
            <button type="button" id="btn-slide-disx" onclick="previousSlide()"   class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600 ">
              Schedule
            </button>
            <button type="button" id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
              Food Menu
            </button>

          </div>
          <div class="hidden sm:flex sm:items-center">
            <div class="pl-4 pr-4 self-stretch">
            <div class="h-full border-l border-gray-200"></div>
            </div>
            <button type="button" @click="$refs[`${activeSnippet}ClipboardCode`].select(); document.execCommand('copy')" class="ml-3 text-gray-400 hover:text-gray-500" >
            <i class="fas fa-calendar-week"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="relative md:h-screen overflow-y-auto overflow-x-hidden mb-8">
        <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide" >
          <div class="grid grid-rows-9 gap-1 w-full">
            <div class=" text-2xl row-span-1">
              Choose Schedule
            </div>
            <div class="flex-row gap-2 row-span-3 px-4 sm:flex-col content-center text-center ">
                <?php $m=1; ?>
                @foreach($months as $month)

                <!--  <a href="{{route('employee.create.order',$month->format('Y-m-d'))}}" class="flex-auto bg-orange-400 rounded-lg p-4 text-white font-base text-base hover:bg-orange-600 duration-1000" onchange="showUser(this.value)">{{$month->format('F')}}</a> -->

                <button id="choose-month" class="flex-auto bg-orange-400 rounded-lg p-4 text-white font-base text-base hover:bg-orange-600 duration-1000" onclick="get_date('{!! $month->format('Y-m-d') !!}')">{{$month->format('F Y')}}</button>
                <?php $m++; ?>
                @endforeach     
            </div>
            <div class="h-10"></div>
            <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data" class=" row-span-4">
            @csrf

            <div class="flex-row gap-2 px-4 mb-8">                       

              <div id="div1" class=" duration-1000 targetDiv bg-gray-200 justify-content content-center text-center rounded-lg"> 
                  <h1 id="date-month" class="mb-4 text-center"></h1>
                  <div id="dates-list">
                    
                  </div>
              </div>
            </div>
            <div class="text-xl row-span-1 text-right pointer px-6 ">
               <a onclick="nextSlide()" id="btn-slide-dis-2y" class="cursor-pointer bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200"> Next  <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
          </div>
        </div>

        <div class="absolute inset-0 w-full h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

          <div class="flex flex-col  ">
            <h3 class="flex-shrink min-w-0 font-regular text-2xl leading-snug truncate mb-5 text-center mt-2">
             Select Your Menu
            </h3>

            <div class="grid grid-cols-2 row-span-2 md:row-span-1 gap-12 w-full p-8">
              
              @foreach($menus as $menu)
              <div class=" text-2xl col-span-2 md:col-span-1">
                <button type="submit" class="hover:opacity-100 opacity-75 duration-500 transition ease-in-out rounded-xl" name="menu" value="{{$menu->menu_code}}">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-xl rounded-lg bg-pink-600"><img alt="..." src="{{url('public/'.$menu->photos->random()->file)}}" class="w-full align-middle h-64  object-cover  rounded-t-lg"><blockquote class="relative p-8 mb-4"><svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height:95px;top:-94px"><polygon points="-30,95 583,95 583,65" class="text-pink-600 fill-current"></polygon></svg><h4 class="text-2xl font-bold text-white">{{$menu->name}}</h4><p class="text-lg font-light mt-2 text-white">{{$menu->desc}}                              
                    </p></blockquote></div>
                </button>
              </div>

              @endforeach
              </form>
            </div>

            <div class=" text-xl row-span-1 text-left pointer px-6">
               <button  onclick="previousSlide()" id="btn-slide-disy" class="ml-2 bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200"><i class="fas fa-arrow-left"></i> Back</button>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('resources/js/myJs.js')}}"></script>
</x-app-layout>
<script type="text/javascript">
  function get_date(month){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('employee.get_date') }}",
            type: "POST",
            data: {month : month},
            success: function(data) {
                var month = data.month;
                if (data == null) {
                    alert('Error get date.');
                }
                else{
                    var input = "";
                    $.each(data.dates, function(d, v){
                        input = input + v;
                    });
                    $("#dates-list").html(input);
                    $("#date-month").html(month);
                }
            }
        });
  }
</script>