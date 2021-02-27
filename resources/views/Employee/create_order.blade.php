<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create Order') }}
    </h2>
  </x-slot>
  <link rel="stylesheet" href="{{asset('resources/css/Foodcheckbox.css')}}" />

  <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
  <div id="success" class="invisible absolute"></div>
  <div id="failure" class="invisible absolute"></div>


  @if (session('message'))
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
    Content:"{{ implode('', $errors->all(':message')) }}";
  }</style> 
  @endif

  <link rel="stylesheet" href="{{ asset('resources/css/date.css') }}">
  <style type="text/css">

    input[type="radio"] + label span {
      transition: background .2s,
      transform .2s;
    }

    input[type="radio"] + label span:hover,
    input[type="radio"] + label:hover span{
      transform: scale(1.2);
    } 

    input[type="radio"]:checked + label span {
      background-color: #3490DC; //bg-blue
      box-shadow: 0px 0px 0px 2px white inset;
    }

    input[type="radio"]:checked + label{
     color: #3490DC;
     border: 2px solid #3490DC !important;
   }
   input[type="radio"]:checked + label:before{
    display: none;
    }
    :checked + .not-menu label:before{
      display: none
    }
    label:before{
         line-height: 262px;
   }
   
</style>
<div class="py-12">
  <div class="max-w-7xl mx-auto lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
      <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
        <div class="flex-shrink min-w-0 flex items-center">
          <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
           Select Meal on Blue Date
          </h3>
        </div>
        <div class="ml-4 flex flex-shrink-0 items-center cursor-pointer">
          <div class="flex items-center text-sm sm:hidden">
            <button onclick="previousSlide()" id="btn-slide-dis" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
              <i class="fas fa-backward"></i>
            </button>
            <button onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
              <i class="fas fa-forward"></i>
            </button>
          </div>
          <div class="hidden sm:flex items-center text-sm md:text-base">
            <button id="btn-slide-disx" onclick="previousSlide()"   class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600 ">
              {{$now->format('F Y')}}
            </button>
            <button id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
              {{$next_month->format('F Y')}}
            </button>

          </div>
          <div class="hidden sm:flex sm:items-center">
            <div class="pl-4 pr-4 self-stretch">
              <div class="h-full border-l border-gray-200"></div>
            </div>
            <a @click="$refs[`${activeSnippet}ClipboardCode`].select(); document.execCommand('copy')" class="ml-3 text-gray-400 hover:text-gray-500" >
              <i class="fas fa-calendar-week"></i>
            </a>
          </div>
        </div>
      </div>
<!-- Create Modal -->

        <div class="bootstrapiso z-50 contents">
          <div class="modal fade" id="ScheduleModal" tabindex="-1" role="dialog" aria-labelledby="MenuPhotosModal1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="MenuPhotosModal1"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="right-4">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <input type="hidden" name="date" id="dateOrder">
                <input type="hidden" name="date" id="dateSelected">
                <div class="modal-body p-0">
                 <div id="carouselExampleControls" class="carousel slide" data-interval="false">
                  <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100">
                      <div class="grid grid-cols-2 p-4 gap-8 bg-gray-50 after-select">
                        <!-- select menu -->
                    </div>

                  </div>
                    
                  <div class="carousel-item h-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 p-4 gap-4 bg-gray-50">
                      <div class="w-full ">
                      <h5 class="font-semibold text-center">Additional Catering</h5>
                      <div class="text-center md:grid md:gridrows-2 flex hide-scroll">                         
                         
                          <input type="radio" name="porsi" value="L" class="flex-auto hidden" id="nasiL">
                          <label for="nasiL" class="flex cursor-pointer text-base font-semibold items-center not-menu px-4 bg-white rounded-xl border hover:shadow-md duration-500">
                           Porsi L
                           </label>
                         
                          
                            <input type="radio" name="porsi" checked value="M" class="flex-auto hidden" id="nasiM">
                            <label for="nasiM"  class="flex cursor-pointer text-base font-semibold items-center not-menu px-4 bg-white rounded-xl border hover:shadow-md duration-500">
                             Porsi M
                           </label>
                         
                         
                          <input type="radio" name="porsi" value="S" class="flex-auto hidden" id="nasiS">
                          <label for="nasiS"  class="flex cursor-pointer text-base font-semibold items-center not-menu px-4 bg-white rounded-xl border hover:shadow-md duration-500">

                           Porsi S
                         </label>
                     
                         <label class="inline-flex items-center mt-3 bg-white px-3 rounded-xl border">
                          <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" name="sambal" value="1"><span class="ml-2 text-gray-700 font-semibold">Sambal</span>
                        </label>
                        
                </div>
                </div>

                <div class="text-center">
                  <h5 class="font-semibold">Catering Delivery</h5>
                  
                    <input type="radio" name="shift" checked value="Pagi" class="flex-auto hidden" id="shiftA">
                    <label for="shiftA" class="flex cursor-pointer text-base font-semibold items-center not-menu px-4 bg-white rounded-xl border hover:shadow-md duration-500">
                     <i class="fas fa-cloud-sun text-blue-400 mr-2"> </i>Shift Pagi
                   </label>
                
                
                  <input type="radio" name="shift" value="Siang" class="flex-auto hidden" id="shiftB">
                  <label for="shiftB" class="flex cursor-pointer text-base font-semibold items-center not-menu px-4 bg-white rounded-xl border hover:shadow-md duration-500">
                    <i class="fas fa-sun text-yellow-400 mr-2"> </i>Shift Siang
                  </label>
               
              </div>

            </div>



          </div>


        </div>

      </div>
    </div>

    <div class="modal-footer">
     <a  href="#carouselExampleControls" role="button" data-slide="prev" style="display: none;" id="back-step">
      <button type="button" class="btn btn-warning" >Back</button>
    </a>

    <a href="#carouselExampleControls" role="button" data-slide="next" id="next-step">
      <button type="button" class="btn btn-success" >Next</button>
    </a>
    <button type="button" class="btn btn-primary" id="save-step" style="display: none;" data-dismiss="modal" onclick="backward()">Save </button>
    <script type="text/javascript">
      var buttonBack = document.getElementById("back-step");        
      var buttonNext = document.getElementById("next-step");       
      var buttonSave = document.getElementById("save-step");

      function backward()
      {
       document.getElementById('back-step').click();
      }


      buttonNext.addEventListener('click', function(event) {
        buttonBack.style.display = "block";
        buttonSave.style.display = "block";
        buttonNext.style.display = "none";        
      });
      buttonBack.addEventListener('click', function(event) {       
        buttonBack.style.display = "none";
        buttonNext.style.display = "block"; 
        buttonSave.style.display = "none";
      });
    </script>

    </form>

  </div>
</div>
</div>
</div>
</div>
<!-- End Modal -->
<div class="relative h-full hide-scroll overflow-y-hidden overflow-x-hidden ">

 <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide" >

  <div class="grid grid-rows-7 gap-1 w-full ">  

    <h3 class="flex-shrink min-w-0 font-medium text-5xl leading-snug text-center mb-6 h-28 md:h-15 ">
     {{$now->format('F')}}
   </h3>  
   <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
     <div id="div1" class="duration-1000 targetDiv bg-gray-100 justify-content content-center text-center rounded-lg pt-4"> 
      @for($i = 1; $i <= $now->daysInMonth; $i++, $start->addDay())
      @php
      $user = auth()->user();
      $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
      $order = App\Models\Order::where('employee_id',$user->id)->where('order_date',$start->format('Y-m-d'))->first();
      @endphp


      <label class='label flex-auto contents duration-1000'>
        <input class='label__checkbox duration-1000 ' name="dates[]" type='checkbox' id="tanggal{{$start->format('Y-m-d')}}"  @if($start < $now && $total_dadakan <= 5) @elseif($schedule == null || $start < $now) disabled @endif value="{{$start->format('Y-m-d')}}" onclick="document.getElementById('tanggal{!! $start->format("Y-m-d") !!}').checked = false;" data-toggle="modal" data-target="#ScheduleModal">

        <span class='label__text '>
          <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient( @if($order != null)  135deg, #FCCF31 10%, #F55555 100% @elseif($schedule != null && $start->day == $now->day && $total_dadakan <= 5) 160deg, #0093E9 0%, #80D0C7 100% @elseif($start < $now) 160deg, #bdbdbe 0%, #032a32 100% @elseif($schedule != null) 160deg, #0093E9 0%, #80D0C7 100%   @else to right, #ff416c, #ff4b2b @endif );'>
            <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>

              <div class='font-semibold text-5xl mb-2 '>{{$start->format('d')}}</div>
              <div class='text-xs font-base'>{{$start->format('l')}}</div>

            </i>
          </span>
        </span>
      </label>
      @if($start->dayOfWeek == 0)     
        <br class="lg:block hidden">      
      @endif

      @endfor

    </div></div>

   
    <script>
      $(document).ready(function(){
        $("#hideDesc").click(function(){
          $("#hideTarget").toggle(500);
        });
        
      });
    </script>

   
 </div>
</div>
</form>
<div class="absolute inset-0 w-full h-full  text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

  <div class="grid grid-rows-7 gap-1 w-full ">  

    <h3 class="flex-shrink min-w-0 font-medium text-5xl leading-snug text-center mb-6 h-28 md:h-15 text-gray-900">
     {{$next_month->format('F')}}
   </h3>  
    <div class="flex-row gap-2 row-span-3 px-4 mb-8 row-span-5 mt-4">                      
     <div id="div1" class="duration-1000 targetDiv  justify-content content-center text-center rounded-lg pt-4"> 
     @if(($now->daysInMonth - $now->day) < 2)
      @for($i = 1; $i <= $next_month->daysInMonth; $i++, $start->addDay())
      @php
      $user = auth()->user();
      $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
      $order = App\Models\Order::where('employee_id',$user->id)->where('order_date',$start->format('Y-m-d'))->first();
      @endphp


      <label class='label flex-auto contents duration-1000'>
        <input class='label__checkbox duration-1000 ' name="dates[]" type='checkbox' id="tanggal{{$start->format('Y-m-d')}}"  @if($schedule == null || $start < $now) disabled @endif value="{{$start->format('Y-m-d')}}" onclick="document.getElementById('tanggal{!! $start->format("Y-m-d") !!}').checked = false;" data-toggle="modal" data-target="#ScheduleModal">

        <span class='label__text '>
          <span class='label__check rounded-lg text-white  duration-1000 text-justify' style='background-image: linear-gradient( @if($order != null)  135deg, #FCCF31 10%, #F55555 100% @elseif($start < $now) 160deg, #bdbdbe 0%, #032a32 100% @elseif($schedule != null) 160deg, #0093E9 0%, #80D0C7 100%   @else to right, #ff416c, #ff4b2b @endif );'>
            <i class='fa icon font-bold absolute text-xl m-auto text-center flex flex-col transform hover:scale-125 p-10 duration-1000' style='font-family: Poppins, sans-serif;'>

              <div class='font-semibold text-5xl mb-2 '>{{$start->format('d')}}</div>
              <div class='text-xs font-base'>{{$start->format('l')}}</div>

            </i>
          </span>
        </span>
      </label>
      @if($start->dayOfWeek == 0)
        <br class="lg:block hidden">
      @endif

      @endfor
      @else
      sorry scheduling is not yet available, please wait 2 days before  <font class="border-b-2">{{$next_month->format('F Y')}}</font>
     @endif
    </div></div>



  <div class="text-xl row-span-1 text-right pointer px-6 ">
 </div>
</div>
</div>
</form>


</div>
</div>

   <div class="flex flex-col row-span-1 text-right pointer px-8 capitalize gap-4 bg-white py-4 ">
        <h4 class="min-w-0  text-xl leading-snug text-left " >
          <button id="hideDesc" class="font-semibold">

         Legend
         </button>
       </h4>
       <div class="flex flex-col gap-2" id="hideTarget">
        <h4 class="min-w-0 font-medium text-lg leading-snug text-left flex items-center">
          <span class="flex h-3 w-3 mr-2">
            <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-purple-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3" style="background-image: linear-gradient( 160deg, #bdbdbe 0%, #032a32 100% );"></span>
          </span>
          Past Days
        </h4>

        <h4 class="min-w-0 font-medium text-lg leading-snug text-left flex items-center">
          <span class="flex h-3 w-3 mr-2">
            <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-orange-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3" style="background-image: linear-gradient( 135deg, #FCCF31 10%, #F55555 100% );"></span>
          </span>
          Catering Submitted
        </h4>

        <h4 class="min-w-0 font-medium text-lg leading-snug text-left flex items-center">
          <span class="flex h-3 w-3 mr-2">
            <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-blue-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3" style="background-image: linear-gradient( 160deg, #0093E9 0%, #80D0C7 100% );"></span>
          </span>
          Catering Available
        </h4>

        <h4 class="min-w-0 font-medium text-lg leading-snug text-left flex items-center">
          <span class="flex h-3 w-3 mr-2">
            <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500" ></span>
          </span>
          Recent Update
        </h4>

        <h4 class="min-w-0 font-medium text-lg leading-snug text-left flex items-center">
          <span class="flex h-3 w-3 mr-2">
            <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3" style="background-image: linear-gradient( to right, #ff416c, #ff4b2b );"></span>
          </span>
          No Catering
        </h4>

      </div>     
     </div>

</div>
</div>
</div>


<script type="text/javascript">
  $('.label__checkbox').click(function() {
    var date = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: "{{ route('employee.get_schedule') }}",
      type: "GET",
      data: {date : date},
      success: function(data) {
        if (data == null) {
          alert('Error get date.');
        }
        else{
          $('#dateOrder').val(data.date);
          $('#dateSelected').val(date);
          $('#MenuPhotosModal1').text("Create Schedule for " + data.date );
          $('.after-select').html(`
          <span class="block col-span-2 -mt-2">
          <h5 class="text-center border-b relative"><span class="relative top-3 px-4 bg-gray-50">Select Your Menu </span></h5>
          </span>
          <input type="checkbox" id="menuradio1" name="menu" value="`+data.menu1.id+`" class="schedule-menu hidden" >
          <label for="menuradio1" class="m-0 p-0 h-60 col-span-2 md:col-span-1" >
            <div class="grayscale-effect">            
              <img  class="object-cover w-100 h-60 inline-block rounded-bl-3xl rounded-tr-3xl hover:shadow-xl bg-white" src="`+data.menu1.photo+`" alt="">
             </div> 
            <div class="md:text-xl text-gray-700  text-lg font-semibold absolute px-4 py-1 rounded-br-lg shadow-md bg-gradient bg-white top-0 hover:z-10">`+data.menu1.name+`</div>

            <div class="absolute md:text-xl text-lg rounded-xl border-orange-300 text-orange-500 leading-7 font-bold flex-initial bg-white  md:py-1 px-2  md:w-auto w-12 text-sm bottom-2 right-2 w-auto" style="border: 2px solid">
              <i class="fas fa-star"></i> 4
            </div>
          </label>`);
          if (data.menu2 != null) {
            $('.after-select').append(`
            <input type="checkbox" id="menuradio2" name="menu" value="`+data.menu2.id+`" class="schedule-menu hidden" >
            <label for="menuradio2" class="m-0 p-0 h-60 col-span-2 md:col-span-1" >
              <div class="grayscale-effect">            
                <img  class="object-cover w-100 h-60 inline-block rounded-bl-3xl rounded-tr-3xl hover:shadow-xl bg-white" src="`+data.menu2.photo+`" alt="">
               </div> 
              <div class="md:text-xl text-gray-700  text-lg font-semibold absolute px-4 py-1 rounded-br-lg shadow-md bg-gradient bg-white top-0 hover:z-10">`+data.menu2.name+`</div>

              <div class="absolute md:text-xl text-lg rounded-xl border-orange-300 text-orange-500 leading-7 font-bold flex-initial bg-white  md:py-1 px-2  md:w-auto w-12 text-sm bottom-2 right-2 w-auto" style="border: 2px solid">
                <i class="fas fa-star"></i> 4
              </div>
            </label>`);
            
            $("input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
              // the name of the box is retrieved using the .attr() method
              // as it is assumed and expected to be immutable
              var group = "input:checkbox[name='" + $box.attr("name") + "']";
              // the checked state of the group/box on the other hand will change
              // and the current value is retrieved using .prop() method
              $(group).prop("checked", false);
              $box.prop("checked", true);
            } else {
              $box.prop("checked", false);
            }
          });
          }
        }
      }
    });
  });

  $('#save-step').click(function() {
    var date = $('#dateOrder').val();
    var dateSelected = $('#dateSelected').val();
    var menu = $("input[name='menu']").val();
    $('input[name="menu"]:checked').each(function() {
       menu = this.value; 
    });
    var porsi = $("input[name='porsi']:checked").val();
    var shift = $("input[name='shift']:checked").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: "{{ route('employee.store.order') }}",
      type: "post",
      data: {date : date, menu : menu, porsi : porsi, shift : shift},
      success: function(data) {
        $('#tanggal'+dateSelected).prop('checked',true);
        alert(data);
      }
    });
  });
</script>
<script src="{{asset('resources/js/myJs.js')}}"></script>


</x-app-layout>
