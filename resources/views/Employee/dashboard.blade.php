<x-app-layout>

  @if($errors->any())
  {{ implode('', $errors->all('<div>:message</div>')) }}
  @endif
  <style type="text/css">
    .pagination-info{
            color: #fff;
          }
  </style>
  @if(session('message'))
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
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  @if($menu_today != null)
  <!--Modal-->
  <form action="{{route('employee.store.review',$menu_today->order_number)}}" method="POST">
    @csrf
    <div class="modal z-10 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
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
            <p class="text-2xl font-bold text-gray-600">Review <font class="text-orange-500">{{$menu_today->menu->name}}</font></p>
            <div class="modal-close cursor-pointer z-50">
              <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
              </svg>
            </div>
          </div>

          <!--Body-->
          <div class="flex flex-wrap mt-6">
            <div class="relative w-full appearance-none label-floating">
              <textarea required name="review" class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-50 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 h-52"
              id="message" type="text" placeholder="Message..."></textarea>
              <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Message...
              </label>
            </div>
          </div>
          <p class="text-xl font-base text-gray-600 font-bold">Rate</p>
          <div class="rating">
            <label>
              <input required type="radio" name="stars" value="1" />
              <span class="icon duration-500 ">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="2" />
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="3" />
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>   
            </label>
            <label>
              <input type="radio" name="stars" value="4" />
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="5" />
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
              <span class="icon duration-500 ">★</span>
            </label>
          </div>
          <!--Footer-->
          <div class="flex justify-end pt-2">

            <button class=" px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Send</button>
          </div>

        </div>
      </div>
    </div>
  </form>
  @endif


  <div class=" border-gray-200 bg-no-repeat bg-cover  bg-center" style="" >

    <div class="bg-white mb-4 rounded-xl shadow-lg flex md:flex-row flex-col">
      @if($menu_today == null)

       <div class="bg-cover bg-top text-center bg-gradient-to-t bg-blue-400 to bg-green-400  bg-center text-white  object-fill w-full" style="background-image: url(https://assets.kompasiana.com/items/album/2018/04/16/suasana-kantor-24slides-indonesia-3-5ad4a44bcaf7db40dd0deff2.jpg?t=o&v=760);background-position-y: -70px;">
        <div class="h-full md:p-20 p-8" style="background-image: linear-gradient(0deg,#252525,#27272769) !important;">
          <p class="font-bold text-2xl uppercase"> Today Breakfast </p>
          <div class="flex md:flex-row flex-col justify-center mb-8 ">
            <p class="text-5xl font-bold leading-none capitalize"> no catering schedule today   </p>        

            </div>
            <p class="text-2xl mb-4 leading-none">Sorry you dont have catering schedule today, Please comeback tommorow  </p>
             
          </div>
         

      </div> 

      @else
      <div class="bg-cover bg-top text-center bg-gradient-to-t bg-blue-400 to bg-green-400  bg-center text-white  object-fill w-full" style="background-image: url({{ url('public/'.$menu_today->menu->photos->random()->file)}});background-position-y: -70px;">
        <div class="h-full md:p-20 p-8" style="background-image: linear-gradient(0deg,#252525,#27272769) !important;">
          <p class="font-bold text-2xl uppercase"> Today Breakfast </p>
          <div class="flex md:flex-row flex-col justify-center mb-8">
            <p class="text-5xl font-bold leading-none "> {{$menu_today->menu->name}}   </p>         

              <p class=" text-xl text-orange-500 leading-7 font-bold border border-orange-300 p-1 px-2 rounded-xl bg-white h-full ml-2  md:mt-0 mt-5">
                <i class="fas fa-star"></i> @if($menu_today->stars != null) {{$menu_today->stars}} Star  @endif
              </p>
           
            </div>
            <p class="text-2xl mb-4 leading-none">{{$menu_today->menu->desc}}</p>
             <div class="mt-4 ">
                      <button @if($menu_today->review != null || $menu_today->stars != null) disabled @endif type="button" class="@if($menu_today->review != null || $menu_today->stars != null) cursor-not-allowed @endif bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 text-white py-3 px-8 rounded-xl opacity-75 hover:opacity-100 duration-200 modal-open text-2xl shadow-2xl mt-6" id="modal-click"><i class="fas fa-feather-alt"></i>@if($menu_today->review != null || $menu_today->stars != null) Review Submited @else Review @endif</button>
                    
                  </div>
          </div>
         

      </div> 
      @endif

   
 @if($menu_tomorrow == null)

       <div class="bg-cover bg-top w-full md:w-1/4 bg-gradient-to-t bg-blue-400 to bg-green-400 bg-center text-white  object-fill" style="background-image: url(https://assets.kompasiana.com/items/album/2018/04/16/suasana-kantor-24slides-indonesia-3-5ad4a44bcaf7db40dd0deff2.jpg?t=o&v=760});">
      <div class=" p-4 h-full px-10 grid grid-rows-4" style="background-image: linear-gradient(60deg,#252525,#27272769) !important;">
        <p class="font-bold text-lg uppercase mb-8 border-b-2 "> Tomorrow Breakfast </p>
        <p class="text-4xl font-bold row-span-2 capitalize"> no catering schedule for tomorrow </p>
         
      </div>

        </div> 

      @else
     
     <div class="bg-cover bg-top w-full md:w-1/4 bg-gradient-to-t bg-blue-400 to bg-green-400 bg-center text-white  object-fill" style="background-image: url(https://assets.kompasiana.com/items/album/2018/04/16/suasana-kantor-24slides-indonesia-3-5ad4a44bcaf7db40dd0deff2.jpg?t=o&v=760});">
      <div class=" p-4 h-full px-10 grid grid-rows-4" style="background-image: linear-gradient(60deg,#252525,#27272769) !important;">
        <p class="font-bold text-lg uppercase mb-8 border-b-2 "> Tomorrow Breakfast </p>
        <p class="text-4xl font-bold row-span-2 capitalize"> no catering schedule for tomorrow </p>
         
      </div>

        </div> 
        @endif
      </div>
    </div>


    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 px-4 mb-8">  
      <div class="p-6 px-8 mt-6 bg-white rounded-xl p-4 shadow-lg">       
        <div class="col-span-2 text-4xl text-left text-gray-600 mb-9 font-base flex item-center">          
          <p class="flex-auto text-left font-semibold ">
            <span class="font-normal text-gray-600"> Schedule </span>{{Carbon\Carbon::now()->format('F Y')}}</p>
          <a href="{{ route('employee.create.order') }}" id="btn-slide-dis-2"  class="inline-block rounded-full font-medium leading-none py-2 px-2 focus:outline-none text-gray-400 hover:text-gray-700 focus:text-blue-600 duration-500">
              <i class="fas fa-plus"></i>
            </a>
        </div>
        @php
        $start_date = $now;
        @endphp
        @for($i = 0 ; $i <= $total_days;$i++,$start_date->addDay())
          @php
          $order = $user->orders->where('order_date',$start_date->format('Y-m-d'))->first();
          $schedule = App\Models\ScheduleMenu::where('date',$start_date->format('Y-m-d'))->first();
          @endphp
        
          @if($schedule == null)
          <div class="flex items-center bg-gradient-to-r from-red-400 to-red-200 border-orange-500 gap-2 p-2 rounded border-l-4 mb-2">
            <div class=" text-center w-8 text-xl text-white leading-7 font-bold flex-initial">
              {{$start_date->format('d')}}
            </div>            
            <div class="ml-4 text-lg text-gray-700 leading-7 font-base flex-auto uppercase font-semibold">
              <a href="#">day off</a>
            </div>

            @elseif($order == null)
            <div class="flex items-center bg-gradient-to-r from-transparent to-gray-200 border-gray-500 gap-2 p-2 rounded border-l-4 mb-2">
              <div class=" text-center w-8 text-xl text-gray-700 leading-7 font-bold flex-initial">
                {{$start_date->format('d')}}
              </div>
              
              <div class="ml-4 text-lg text-gray-700 leading-7 font-base flex-auto uppercase font-semibold">
                <a href="#">empty schedule</a>
              </div>

          
          @elseif($order != null)    
           <div class="flex items-center bg-gradient-to-r from-transparent to-blue-200 border-blue-500 gap-2 p-2 rounded border-l-4 mb-2">
          <div class=" text-center w-8 text-xl text-blue-400 leading-7 font-bold flex-initial">
            {{$start_date->format('d')}}
          </div>

          <div class="ml-4 text-lg text-gray-700 leading-7 font-base flex-auto">
            <a href="#">{{$order->menu->name}}</a>
          </div>
        
            <img src="{{ url('public/'.$order->menu->photos->random()->file)}}" class="object-cover h-8 w-8 rounded flex-initial">
        
          @endif
        </div>

        @endfor
      </div>

      <div class="p-6 mt-6">       
        <div class="col-span-2 text-4xl text-center mb-6 font-base">          
          My Feed & Review
        </div>
        @foreach($reviews as $review)
        @if($review->review == null)
        @php continue; @endphp
        @endif
        @if($loop->iteration % 2 != 0)
        <div class=" rounded-lg bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex ">
          <img src="{{ url('public/'.$review->menu->photos->random()->file)}}" class="object-cover h-10 w-10 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-l-lg">
          <div class="flex flex-col p-3 flex-auto">
            <div class="flex items-center">           
              <div class=" text-lg flex-auto text-gray-600 leading-7 font-semibold"><a href="https://laravel.com/docs">{{$review->menu->name}}</a>
                <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                  {{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}
                </div>
              </div>
              <div class=" text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl">
                <i class="fas fa-star"></i> {{$review->stars}}
              </div>
            </div>        
            <div >
              <div class="mt-2 text-sm text-gray-500">
                {{$review->review}}
              </div>           
              <div class="mt-3 flex items-center">

              </div>
            </div>
          </div>
        </div>
        {{$loop->iteration}}
        @else
        <div class=" rounded-lg bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex flex-row-reverse">
          <img src="{{ url('public/'.$review->menu->photos->random()->file) }}" class="object-cover h-10 w-10 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-r-lg">
          <div class="flex flex-col p-3 flex-auto">
            <div class="flex flex-row-reverse items-center">           
              <div class=" text-lg flex-auto text-right text-gray-600 leading-7 font-semibold">
                <a href="https://laravel.com/docs">{{$review->menu->name}}</a>
                <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                  {{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}
                </div>
              </div>
              <div class=" text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl mr-2">
                <i class="fas fa-star"></i> {{$review->stars}}
              </div>
            </div>        
            <div>
              <div class="mt-2 text-sm text-gray-500 text-right">
                {{$review->review}}
              </div>           
              <div class="mt-3 flex items-center">

              </div>           
            </div>
          </div>
        </div>
         {{$loop->iteration}}
        @endif
        @endforeach

         <span id="pc1" class="contents hidden"> 
           @foreach($reviews as $review)
        @if($review->review == null)
        @php continue; @endphp
        @endif
        @if($loop->iteration % 2 != 0)
        <div class=" rounded-lg bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex ">
          <img src="{{ url('public/'.$review->menu->photos->random()->file)}}" class="object-cover h-10 w-10 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-l-lg">
          <div class="flex flex-col p-3 flex-auto">
            <div class="flex items-center">           
              <div class=" text-lg flex-auto text-gray-600 leading-7 font-semibold"><a href="https://laravel.com/docs">{{$review->menu->name}}</a>
                <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                  {{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}
                </div>
              </div>
              <div class=" text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl">
                <i class="fas fa-star"></i> {{$review->stars}}
              </div>
            </div>        
            <div >
              <div class="mt-2 text-sm text-gray-500">
                {{$review->review}}
              </div>           
              <div class="mt-3 flex items-center">

              </div>
            </div>
          </div>
        </div>
        @else
        <div class=" rounded-lg bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex flex-row-reverse">
          <img src="{{ url('public/'.$review->menu->photos->random()->file) }}" class="object-cover h-10 w-10 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-r-lg">
          <div class="flex flex-col p-3 flex-auto">
            <div class="flex flex-row-reverse items-center">           
              <div class=" text-lg flex-auto text-right text-gray-600 leading-7 font-semibold">
                <a href="https://laravel.com/docs">{{$review->menu->name}}</a>
                <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                  {{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}
                </div>
              </div>
              <div class=" text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl mr-2">
                <i class="fas fa-star"></i> {{$review->stars}}
              </div>
            </div>        
            <div>
              <div class="mt-2 text-sm text-gray-500 text-right">
                {{$review->review}}
              </div>           
              <div class="mt-3 flex items-center">

              </div>           
            </div>
          </div>
        </div>
        @endif
        @endforeach
         </span>
        <button onclick="pcsh1()" class="contents cursor-pointer" id="pc2">
            <div class="bg-gray-500 col-start-4 col-end-7 rounded-full my-4 mr-auto shadow-md animate transform transition-transform hover:translate-y-2 hover:bg-gray-700 duration-1000 text-center mx-auto cursor-pointer w-4/12 py-3">
              <h3 class="font-semibold text-white "><i class="fas fa-chevron-down text-4xl"></i></h3>          

            </div>
          </button> 

          <div class="hidden contents" id="pc3">
            <button onclick="pcsh1()" class="contents cursor-pointer">
              <div class="bg-gray-500 col-start-4 col-end-7 rounded-full my-4 mr-auto shadow-md animate transform transition-transform hover:-translate-y-2 hover:bg-gray-700 duration-1000 mx-auto text-center cursor-pointer  w-4/12 py-3">
                <h3 class="font-semibold text-white "><i class="fas fa-chevron-up text-4xl"></i></h3>  

              </div>
            </button>
            <a href="{{route('admin.index.review')}}" class="contents cursor-pointer">
              <div class="bg-orange-500 col-start-4 col-end-7 rounded-full my-4 mx-auto shadow-md animate transform transition-transform hover:translate-y-2 hover:bg-orange-700 duration-1000 w-4/12 py-3 text-center cursor-pointer">

                <h3 class="font-semibold text-xl mb-1 text-white">See All</h3> 

              </div>
            </a>  
          </div>

       <!--  <div class="w-full text-center  animate transform transition-transform hover:translate-y-1 duration-1000">
          <a href="#kemanaya" class="bg-gray-700 px-6 py-2 rounded-lg  shadow-lg text-white opacity-75 transform hover:opacity-100  focus:border-gray-200 hover:translate-x-2  "> Show More</a>
        </div> -->
      </div>





    </div>
  </div>
      <script type="text/javascript">
        function pcsh1() {
        var x = document.getElementById("pc1");
        var x1 = document.getElementById("pc2");
        var x2 = document.getElementById("pc3");
        if (x.classList.contains("hidden")) {
          x.classList.remove("hidden");
          x1.classList.add("hidden");
          x2.classList.remove("hidden");
        } else {
          x.classList.add("hidden");
          x1.classList.remove("hidden");
          x2.classList.add("hidden");
        }
      }

    </script>
    <script type="text/javascript">
      $(':radio').change(function() {
      });
    </script>
  </x-app-layout>
