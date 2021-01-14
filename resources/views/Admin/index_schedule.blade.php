<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Off Date') }}
        </h2>
    </x-slot>
     <link rel="stylesheet" href="{{ asset('resources/css/date.css') }}">
      <style type="text/css">
      
      @keyframes check {
 
        50% {
          
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: 1;
            opacity: 0.6;
        }
        100% {
           
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: 1;
            opacity: 1;
        }
    </style>
    @if (session('message'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <div class="py-12">

       <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
          <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
            <div class="flex-shrink min-w-0 flex items-center">
              <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
  
  Schedule selection Off Days for catering
            </h3>
        </div>
        
    </div>

    <form action="{{route('admin.store.schedule')}}" method="POST">
    @csrf
    <div class="relative md:h-92">
        <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide" >
            <div class="grid grid-rows-7 gap-1 w-full ">  

              <div class="flex md:flex-row flex-col px-4 content-center text-left ">
                <div class="flex-initial">       
                  <span class="text-gray-700 text-lg  mr-5">Choose Month</span>
                </div>
                <div class="flex-auto">
                  <!-- <input type="month" name="month" class="month-select border py-2 px-3 rounded-lg w-full text-lg"> -->
                  <select class="form-select w-full month-select text-lg " name="month" >
                    <option>Select</option>
                    @foreach($months as $month)
                    <option value="{{$month->format('Y-m')}}">{{$month->format('F Y')}}</option>
                    @endforeach
                  </select>
                </div>   
              </div>


        <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
               <div id="div1" class=" duration-1000 targetDiv bg-gray-50 justify-content content-center text-center rounded-lg pt-4"> 
                  <h1 id="date-month" class=" text-center"></h1>
                  <div id="showresults">     
                  </div>
              </div>
          </div>
          <div class="text-xl row-span-1 text-right pointer ">
             <button type="submit" id="btn-slide-dis-2y" class="cursor-pointer bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200 md:w-48 w-full"> Save  </i>
             </button>
         </div>
    </form>
 </div>
</div>


</div>
</div>
</div>



</div>
</x-app-layout>
<script type="text/javascript">
    $('.month-select').change(function() {
        var date = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('admin.get_month_schedule') }}",
            type: "POST",
            data: {month : date},
            success: function(data) {
                if (data == null) {
                    alert('Error get date.');
                }
                else{
                    var input = "";
                    $.each(data, function(d, v){
                        input = input + v;
                    });
                    $("#showresults").html(input);
                }
            }
        });
    });
</script>
