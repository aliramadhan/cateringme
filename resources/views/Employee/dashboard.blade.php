<x-app-layout>

    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <style type="text/css">

    </style>

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
                <p class="text-2xl font-bold">Review {{$menu_today->menu->name}}</p>
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


    <div class="p-6  bg-white border-b border-gray-200">
        <div class=" text-2xl">
            My Catering Schedule 
        </div>
        <div class="mt-6 text-gray-700 grid md:grid-cols-2 grid-rows-2 ">
            @if($menu_today == null)

            @else
            <div class="flex gap-4">
                <div><img src="{{ url('public/'.$menu_today->menu->photos->random()->file)}}" class="object-cover h-28 w-28 rounded"></div>
                <div> 
                    <div class="flex-col gap-4">
                        <b class="text-lg">
                            Today Breakfast
                        </b>
                        <div>
                            {{$menu_today->menu->name}}
                            @if($menu_today->review != null)
                                @for($i = 1; $i <= $menu_today->stars; $i++)
                                    <span class="icon duration-500 ">★</span>
                                @endfor
                            @endif
                        </div>
                        <div class="mt-4 ">
                            <button @if($menu_today->review != null || $menu_today->stars != null) disabled @endif type="button" class="@if($menu_today->review != null || $menu_today->stars != null) cursor-not-allowed @endif bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500 duration-200 modal-open w-full" id="modal-click"><i class="fas fa-feather-alt"></i>@if($menu_today->review != null || $menu_today->stars != null) Review Submited @else Review @endif</button>
                          
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($menu_tomorrow == null)

            @else
            <div class="flex gap-4 ml-0 md:ml-2 md:mt-0 mt-4 text-gray-500">
                <div>
                    <img src="{{ url('public/'.$menu_tomorrow->menu->photos->random()->file)}}" class="object-cover h-28 w-28 rounded opacity-75 hover:opacity-100">
                </div>
                <div> 
                    <div class="flex-col gap-4">
                        <b class="text-lg">
                            Tomorrow Breakfast
                        </b>
                        <div>
                        {{$menu_tomorrow->menu->name}}
                        </div>
                        <div class="mt-4 ml-2">
                            <button type="button" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500 duration-200d disabled:opacity-50" disabled><i class="fas fa-feather-alt"></i>Review</button>                      
                        </div>                     
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 ">  
        <div class="p-6 px-8 mt-6">       
            <div class="col-span-2 text-2xl text-center mb-6 font-base">          
                {{Carbon\Carbon::now()->format('F Y')}} Schedule
            </div>
            @php
            $start_date = $now->startOfMonth    ();
            @endphp
            @for($i = 1; $i <= $now->daysInMonth;$i++,$start_date->addDay())
            @php
            $order = $user->orders->where('order_date',$start_date->format('Y-m-d'))->first();
            @endphp
            <div class="flex items-center bg-gradient-to-r from-transparent to-gray-200 border-orange-500 gap-2 p-2 rounded border-l-4 mb-2">
                <div class="ml-2 text-xl text-blue-700 leading-7 font-bold bg-blue flex-initial">
                    {{$i}}
                </div>
                @if(in_array($start_date->day, $off_date))
                    Off Date
                @elseif($order == null)
                    None
                @else    
                <div class="ml-4 text-lg text-gray-700 leading-7 font-base flex-auto">
                    <a href="https://laravel.com/docs">{{$order->menu->name}}</a>
                </div>
                <img src="{{ url('public/'.$order->menu->photos->random()->file)}}" class="object-cover h-8 w-8 rounded flex-initial">
                @endif
            </div>
            @endfor
        </div>

        <div class="p-6 mt-6">       
            <div class="col-span-2 text-2xl text-center mb-6 font-base">          
                My Feed & Review
            </div>
            @foreach($reviews as $review)
            @if($review->review == null)
                @php continue; @endphp
            @endif
            @if($loop->iteration % 2 != 0)
                <div class=" rounded-lg bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex ">
                    <img src="{{ url('public/'.$review->menu->photos->random()->file)}}" class="object-cover h-10 w-10 flex-none bg-cover h-48 lg:h-auto lg:w-14 overflow-hidden rounded-l-lg">
                    <div class="flex flex-col p-3">
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
                    <div class="flex flex-col p-3">
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
            <div class="w-full text-center  animate transform transition-transform hover:translate-y-1 duration-1000">
              <a href="#kemanaya" class="bg-gray-700 px-6 py-2 rounded-lg  shadow-lg text-white opacity-75 transform hover:opacity-100  focus:border-gray-200 hover:translate-x-2  "> Show More</a>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(':radio').change(function() {
      });
    </script>
</x-app-layout>
