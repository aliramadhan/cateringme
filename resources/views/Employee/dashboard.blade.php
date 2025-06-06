<x-app-layout>
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
  
  <style type="text/css">
    .pagination-info{
            color: #fff;
          }
  </style>
  <x-slot name="header" >
    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-start md:items-center">
    <h2 class="font-semibold text-2xl tracking-tight text-gray-800 leading-tight">
      Welcome Back, <span class="font-normal tracking-wide capitalize">{{ $user->name }}</span> 
    </h2>
    <label class="bg-gray-200 px-3 py-1 rounded-md tracking-wide">{{ $user->division }} </label> 
    </div>
  </x-slot>

  @if($menu_today != null)
  <!--Modal-->
  <form action="{{route('employee.store.review',$menu_today->order_number)}}" method="POST">
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
              <p class="text-xl font-base text-gray-600 font-bold">Review</p>
              <textarea required name="review" class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-50 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 h-52"
              id="message" type="text" placeholder="Message...">{{$menu_today->review}}</textarea>
              <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Write your Review ...
              </label>
            </div>
          </div>
          <p class="text-xl font-base text-gray-600 font-bold">Rate</p>
          <div class="rating">
            <label>
              <input required type="radio" name="stars" @if($menu_today->stars == 1) checked @endif value="1" />
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
            </label>
            <label>
              <input type="radio" name="stars" @if($menu_today->stars == 2) checked @endif value="2" />
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
            </label>
            <label>
              <input type="radio" name="stars" @if($menu_today->stars == 3) checked @endif value="3" />
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>   
            </label>
            <label>
              <input type="radio" name="stars" @if($menu_today->stars == 4) checked @endif value="4" />
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
            </label>
            <label>
              <input type="radio" name="stars" @if($menu_today->stars == 5) checked @endif value="5" />
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
              <span class="icon duration-500 text-2xl mx-1"><i class="fas fa-star"></i></span>
            </label>
          </div>
          <div class="flex flex-wrap mt-6">
            <div class="relative w-full appearance-none label-floating">
              
              <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Message...
              </label>
            </div>
          </div>
          <!--Footer-->
          <div class="flex justify-end pt-2">

            <button type="submit" name="submit" value="storeReview" class=" px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Send</button>
          </div>

        </div>
      </div>
    </div>


   <div class="modal z-20 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center" id="noteModal">
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
            <p class="text-2xl font-bold text-gray-600">Notes <font class="text-blue-500">{{$menu_today->menu->name}}</font></p>
            <div class="modal-close cursor-pointer z-50">
              <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
              </svg>
            </div>
          </div>

          <!--Body-->
          <div class="flex flex-wrap mt-6">
            <div class="relative w-full appearance-none label-floating">
              <p class="text-xl font-base text-gray-600 font-bold">Note</p>
              <textarea name="note" class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-50 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 h-52"
              id="message" type="text" placeholder="Message...">{{$menu_today->note}}</textarea>
              <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Write your Notes ...
              </label>
            </div>
          </div>
          
          <!--Footer-->
          <div class="flex justify-end pt-2">

            <button type="submit" name="submit" value='storeNote' class=" px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
          </div>

        </div>
      </div>
    </div>

  </form>
  @endif


  <div class=" border-gray-200 bg-no-repeat bg-cover bg-center "  >

    <div class=" mb-4 rounded-xl shadow-lg flex md:flex-row flex-col h-100">
      @if($menu_today == null)
      <div class="bootstrapiso shadow-lg w-full h-full">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
     
      <div class="carousel-inner  h-auto">
        @foreach($slideshows as $slideshow)
          <div class="carousel-item @if($loop->iteration == 1) active @endif h-100">
            <img class="d-block w-full  object-cover " style="height: 532px;" src="@if($slideshow->file == null) {{url('public/images/no-image.png')}} @else {{url('public/'.$slideshow->file)}} @endif" alt="{{$slideshow->name}}">
          </div>
        @endforeach
        <?php 
         for ($i=0; $i <= 1; $i++) { 
          
          ?>
        
      <?php }  ?>
         <div class="h-full md:px-20 m-auto pt-10 md:pb-40 md:pt-20 absolute text-white text-center" style="background-image: linear-gradient(0deg,#252525,#27272769) !important;">
          <p class="font-bold text-2xl uppercase"> Today's Meal </p>
          <div class="flex md:flex-row flex-col justify-center mb-10 ">
            <p class="text-5xl font-bold leading-none mt-5  capitalize"> you don't have any meal scheduled today   </p>        

          </div>
        

        </div>     
        
      </div>
      
    </div>
  </div>
     <!--  <div class="bg-cover bg-top text-center bg-gradient-to-t bg-blue-400 to bg-green-400  bg-center text-white  object-fill w-full" style="background-image: url(@if($slideshows->first() == null) {{url('public/images/no-image.png')}} @else {{url('public/'.$slideshows->first()->file)}} @endif);background-position-y: -70px;">

        <div class="h-full md:px-20 p-8 md:pb-40 md:pt-20" style="background-image: linear-gradient(0deg,#252525,#27272769) !important;">
          <p class="font-bold text-2xl uppercase"> Today's Meal </p>
          <div class="flex md:flex-row flex-col justify-center mb-10 ">
            <p class="text-5xl font-bold leading-none mt-5  capitalize"> you don't have any meal scheduled today   </p>        

          </div>
        

        </div>       
      </div> 
 -->
      @else
      <div class="bg-cover bg-top text-center bg-gradient-to-t bg-blue-400 to bg-green-400  bg-center text-white  object-fill w-full" style="background-image: url(@if($menu_today->menu->photos->first() != null){{ url('public/'.$menu_today->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif);background-position-y: -70px;">
        <div class="h-full md:px-20 p-8 md:pb-40 md:pt-20" style="background-image: linear-gradient(0deg,#252525,#27272769) !important;">
          <p class="font-bold text-2xl uppercase">Today's Meal </p>
          <div class="flex md:flex-row flex-col justify-center mb-8">
            <p class="text-5xl font-bold leading-none "> {{$menu_today->menu->name}}   </p>         

              <p class=" text-xl text-orange-500 leading-7 font-bold border border-orange-300 p-1 px-2 rounded-xl bg-white h-full ml-2  md:mt-0 mt-5 hidden md:block">
                <i class="fas fa-star"></i> @if($menu_today->stars != null) {{$menu_today->stars}} Star  @endif
              </p>
               <p class=" text-xl text-orange-500 leading-7 font-bold border border-orange-300 p-1 px-2 rounded-xl bg-white h-full ml-2  md:mt-0 mt-5  md:hidden block">
                @for($i = 1; $i <= $menu_today->stars; $i++) <i class="fas fa-star mx-2"></i> @endfor
              </p>
           
            </div>
            <p class="text-2xl mb-4 leading-none">{{$menu_today->menu->desc}}</p>
             <div class="mt-4 ">
                      <button type="button" class="bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 text-white py-3 px-8 rounded-xl opacity-75 hover:opacity-100 duration-200 modal-open text-2xl shadow-2xl mt-6 w-full md:w-auto" data-toggle="modal" data-target="reviewModal"><i class="fas fa-feather-alt"></i>@if($menu_today->review != null || $menu_today->stars != null) Edit Review @else Review @endif</button>

                       <button type="button" class="bg-gradient-to-r from-blue-400 via-blue-500 to-indigo-500 text-white py-3 px-8 rounded-xl opacity-75 hover:opacity-100 duration-200 modal-open text-2xl shadow-2xl mt-6 md:ml-6 w-full md:w-auto" data-toggle="modal" data-target="noteModal"><i class="far fa-clipboard"></i>@if($menu_today->note != null) Edit Note @else Note @endif</button>
                  </div>
          </div>
         

      </div> 

      @endif

   
 @if($menu_tomorrow == null)

       <div class="bg-cover bg-top w-full md:w-1/4 bg-gradient-to-t bg-blue-400 to bg-green-400 bg-center text-white  object-fill" style="background-image: url(https://assets.kompasiana.com/items/album/2018/04/16/suasana-kantor-24slides-indonesia-3-5ad4a44bcaf7db40dd0deff2.jpg?t=o&v=760);">
      <div class="hide-scroll p-4 h-full px-10 grid grid-rows-4" style="background-image: linear-gradient(60deg,#252525,#27272769) !important;">
        <div>
        <p class="font-bold text-lg uppercase mb-8 border-b-2 "> Tomorrow's meal </p>
        </div>
        <p class="text-4xl font-bold row-span-2 capitalize -mt-5 leading-tight"> no catering schedule for tomorrow </p>
         
      </div>

        </div> 

      @else
     
     <div class="bg-cover bg-top w-full md:w-1/4 bg-gradient-to-t bg-blue-400 to bg-green-400 bg-center text-white  object-fill" style="background-image: url(@if($menu_tomorrow->menu->photos->first() != null ){{url('public/'.$menu_tomorrow->menu->photos->first()->file)}} @else {{url('public/images/no-image.png')}} @endif);">
      <div class=" p-4 h-full px-10 grid grid-rows-4" style="background-image: linear-gradient(60deg,#252525,#27272769) !important;">
        <div>
        <p class="font-bold text-lg uppercase mb-8 border-b-2 "> Tomorrow's meal </p>
       </div>
        <p class="text-4xl font-bold row-span-2 capitalize"> {{$menu_tomorrow->menu->name}} </p>
         
      </div>

        </div> 
        @endif
      </div>
    </div>

      <div class="flex px-5 md:px-10 mb-0 md:mb-8 mt-8 md:-mt-28 gap-4 w-full py-6  ">      
      
        <div class="bg-white z-10 md:grid md:grid-cols-2 xl:grid-cols-4 rounded-2xl md:px-8 md:py-6 py-2 shadow-xl mx-auto flex hide-scroll w-full">
           <div class="absolute bg-red-500 px-6 py-4 text-white z-10 -mt-12  md:ml-6 ml-15 rounded-2xl">
        Weekly Report </div>
        <div class="w-full px-4 mt-4 md:mt-0 border-0 xl:border-r-2">         
            <a href="{{ route('employee.create.order') }}">
            <div class="bg-white relative overflow-hidden   animate transform transition-transform hover:-translate-y-2 duration-1000 h-full">
              <div class="p-6 text-left relative mt-1">
                <div class="flex items-center gap-4 ">
                  <i class="fas fa-calendar-plus rounded-full bg-green-200 text-green-500 p-5 text-3xl"></i>
                  <div class="flex flex-col flex-auto">
                  <h3 class="text-4xl text-green-500 font-semibold leading-none">{{$total_catering}}</h3>
                  <h4 class="text-base font-semibold uppercase flex-auto text-gray-500 leading-none">catering is taken</h4>
                  </div>
                </div>
                               
              </div>              
              </div>
            </a>
          
        </div>
        <div class="w-full px-4 mt-4 md:mt-0 border-0 xl:border-r-2">
         
            <a href="{{ route('employee.create.order') }}">
              <div class="bg-white relative overflow-hidden  animate transform transition-transform hover:-translate-y-2 duration-1000 h-full">
                <div class="p-6 text-left relative mt-1">
                  <div class="flex items-center gap-4 ">
                    <i class="fas fa-calendar-times rounded-full bg-red-200 text-red-500 p-5 text-3xl"></i>
                    <div class="flex flex-col flex-auto">
                      <h3 class="text-4xl text-red-500 font-semibold leading-none">{{$total_dayoff}}</h3>  
                      <h4 class="text-base font-semibold uppercase flex-auto text-gray-500 leading-none">No catering</h4>
                    </div>
                  </div>

                </div>              
              </div>
            </a>
         
        </div>
        <div class="w-full px-4 mt-4 md:mt-0 border-0 xl:border-r-2">
          
            <a href="{{ route('employee.create.order') }}">
              <div class="bg-white relative overflow-hidden   animate transform transition-transform hover:-translate-y-2 duration-1000 h-full">
                <div class="p-6 text-left relative mt-1">
                  <div class="flex items-center gap-4 ">
                    <i class="fas fa-calendar rounded-full bg-indigo-200 text-indigo-500 p-5 text-3xl"></i>
                    <div class="flex flex-col flex-auto">
                      <h3 class="text-4xl text-indigo-500 font-semibold leading-none">{{$total_empty_order}}</h3>
                      <h4 class="text-base font-semibold uppercase flex-auto text-gray-500 leading-none flex-auto ">empty schedule</h4>
                    </div>
                  </div>               

                </div>              
              </div>
            </a>
         
        </div>
        <div class="w-full px-4 mt-4 md:mt-0">         
            <a href="{{ route('employee.history.review') }}">
              <div class="bg-white relative overflow-hidden   animate transform transition-transform hover:-translate-y-2 duration-1000 h-full">
                <div class="p-6 text-left relative mt-1">
                  <div class="flex items-center gap-4 ">
                    <i class="fas fa-feather-alt rounded-full bg-blue-200 text-blue-500 p-5 text-3xl"></i>
                    <div class="flex flex-col flex-auto">
                      <h3 class="text-4xl text-blue-500 font-semibold leading-none">{{$total_review}}</h3>
                      <h4 class="text-base font-semibold uppercase text-gray-500 leading-none flex-auto">Review & Feeds</h4>
                    </div>
                  </div>                

                </div>              
              </div>
            </a>          
        </div>

        </div>
      </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 md:px-6 mb-8 px-0">  
      <div class="p-6 px-6 mx-6 mt-6 bg-white rounded-xl p-4 shadow-lg">       
        <div class="col-span-2 text-4xl text-left text-gray-600 mb-9 font-base flex item-center">          
          <p class="flex-auto text-left font-semibold leading-tight">
            <span class="font-normal text-gray-600"> Schedule </span>{{Carbon\Carbon::now()->format('F Y')}}</p>
          <a href="{{ route('employee.create.order') }}" id="btn-slide-dis-2"  class="inline-block rounded-full leading-none focus:outline-none text-gray-400 hover:text-gray-700  focus:outline-none duration-500">
              <i class="fas fa-plus p-2 border rounded-full text-lg hover:border-blue-400  focus:outline-none"></i>
            </a>
        </div>
        @php
        $start_date = $now;
        $img_modal=1;
        if(Carbon\Carbon::now()->day > 28){
          $total_days += 30;
        }
        @endphp
        @for($i = 0 ; $i <= $total_days;$i++,$start_date->addDay())
          @php
          $order = $user->orders->where('order_date',$start_date->format('Y-m-d'))->first();
          $schedule = App\Models\ScheduleMenu::where('date',$start_date->format('Y-m-d'))->first();
          @endphp
        
          @if($schedule == null)
          <div class="flex items-center bg-gradient-to-r from-red-400 to-red-200 border-orange-500 gap-2 p-2 rounded border-l-4 mb-2 hover:border-gray-700 duration-300 hover:text-gray-600 text-white">
          <div class=" text-center w-8 text-xl  leading-7 font-bold flex-initial">
            {{$start_date->format('d')}}
          </div>            
          <div class="ml-4 text-lg text-gray-700 leading-7 font-base flex-auto uppercase font-semibold">
            <a href="#">day off</a>
          </div>
          @elseif($order == null)
          
          <div class="flex items-center bg-gradient-to-r from-transparent to-gray-200 border-gray-500 gap-2 p-2 rounded border-l-4 mb-2  animate transform transition-transform hover:translate-x-2 duration-500 hover:bg-gray-200">
          
          <div class=" text-center w-8 text-xl text-gray-700 leading-7 font-bold flex-initial">
            {{$start_date->format('d')}}
          </div>
          
          <div class="ml-4 text-lg text-gray-700 leading-7 font-base flex-auto uppercase font-semibold">
            <a href="{{route('employee.create.order')}}">empty order</a>
          </div>
          @elseif($order != null)    
            @if($start_date < Carbon\Carbon::now())

            <div class="flex items-center bg-gradient-to-r from-transparent to-orange-200 border-orange-500 gap-2 p-2 rounded border-l-4 mb-2">
            <div class=" text-center w-8 text-xl text-orange-400 leading-7 font-bold flex-initial">
               
            @else
            <div class="flex items-center bg-gradient-to-r from-transparent to-blue-200 border-blue-500 gap-2 p-2 rounded border-l-4 mb-2">
            <div class=" text-center w-8 text-xl text-blue-400 leading-7 font-bold flex-initial">
            @endif
            {{$start_date->format('d')}}

          </div>

          <div class="ml-4 text-lg text-gray-700 leading-7 font-base flex-auto">
            <a href="#">{{$order->menu_name}} 
               @if($order->is_sauce=='1')
              <i class="fas fa-pepper-hot text-red-600 ml-1"></i>
              @endif
              @if($order->shift=='Pagi')
              <i class="fas fa-cloud-sun text-blue-400 ml-1"> </i>
              @else
               <i class="fas fa-sun text-yellow-400 ml-1"> </i>
              @endif            
            </a>
          </div>

            <img src="@if($order->menu->photos->first() != null){{ url('public/'.$order->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-8 w-8 mr-2 rounded flex-initial transform hover:scale-125 duration-500 ease-in-out hover:shadow=lg" >
        
            @if($start_date > Carbon\Carbon::now())
            <a href="{{route('employee.delete.order',$order->id)}}" onclick="return confirm('Cancel order date {{$start_date->format('d, M Y')}}')">
              <div class="close-container shadow-lg">
                <div class="leftright bg-white "></div>
                <div class="rightleft bg-white "></div>
              </div>
            </a>
            @endif
        
          @endif

        </div>

        @endfor
        <div class="flex items-center mt-8">
          <a href="{{ route('employee.history.order') }}" class="bg-gray-700 text-white py-4 font-semibold text-center w-full rounded-xl tracking-wider hover:bg-gray-900 shadow-lg">My History</a>
        </div>
      </div>

      <div class="p-6 mt-6">       
        <div class="col-span-2 text-4xl text-center mb-6 font-base text-gray-700">          
          <span class="font-semibold">My</span> Feed & Review
        </div>
        @foreach($reviews as $review)

        @if($review->review == null)
          @php continue; @endphp
        @endif
        @if($loop->iteration < 5)
          @if($loop->iteration % 2 != 0)
          <div class=" rounded-lg bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex ">
            <img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 md:w-10 w-20 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-l-lg">
            <div class="flex flex-col p-3 flex-auto">
              <div class="flex items-center">           
                <div class="text-lg flex-auto text-gray-600 leading-7 font-semibold w-auto mr-1"><a href="#">{{$review->menu->name}}</a>
                  <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                    {{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}
                  </div>
                </div>
                <div class="md:text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 md:py-1 px-2 rounded-xl md:w-auto w-12 text-sm">
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
            <img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file) }} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 md:w-10 w-20 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-r-lg">
            <div class="flex flex-col p-3 flex-auto">
              <div class="flex flex-row-reverse items-center">           
                <div class=" text-lg flex-auto text-right text-gray-600 leading-7 font-semibold">
                  <a href="https://laravel.com/docs">{{$review->menu->name}}</a>
                  <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                    {{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}
                  </div>
                </div>
                <div class="md:text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 md:py-1 px-2 rounded-xl md:w-auto w-12 text-sm mr-2">
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
        @else
          <span id="pc1" class="contents hidden"> 
          @if($loop->iteration % 2 != 0)
          <div class=" rounded-lg bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex ">
            <img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 md:w-10 w-20 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-l-lg">
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
            <img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file) }} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 md:w-10 w-20 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-r-lg">
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
           </span>
        @endif
        @endforeach

        @if($reviews->count() >= 5)
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
            <a href="{{route('catering.index.review')}}" class="contents cursor-pointer">
              <div class="bg-orange-500 col-start-4 col-end-7 rounded-full my-4 mx-auto shadow-md animate transform transition-transform hover:translate-y-2 hover:bg-orange-700 duration-1000 w-4/12 py-3 text-center cursor-pointer">

                <h3 class="font-semibold text-xl mb-1 text-white">See All</h3> 

              </div>
            </a>  
          </div>
        @endif
       <!--  <div class="w-full text-center  animate transform transition-transform hover:translate-y-1 duration-1000">
          <a href="#kemanaya" class="bg-gray-700 px-6 py-2 rounded-lg  shadow-lg text-white opacity-75 transform hover:opacity-100  focus:border-0-gray-200 hover:translate-x-2  "> Show More</a>
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

  <script type="text/javascript">
    function get_photos(id){
      $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url: "{{ route('employee.get_photos') }}",
              type: "POST",
              data: {menu_id : id},
              success: function(data) {
                  if (data == null) {
                      alert('Error get Menu.');
                  }
                  else{
                      var input = "";
                      var menu = "";
                      $.each(data.data, function(d, v){
                        input = input + v;
                      });
                      $(".photos-menu").html(input);
                      console.log(data.menu.name);
                      $("#MenuPhotosModal").html(data.menu.name);
                  }
              }
          });
    }
  </script>
<script src="{{asset('resources/js/slider.js')}}"></script>
  </x-app-layout>
