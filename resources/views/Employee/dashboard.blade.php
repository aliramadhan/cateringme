<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                        </div>
                        <div class="mt-4 ml-2">
                            <button type="button" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500 duration-200" ><i class="fas fa-feather-alt"></i>  Review</button>
                            <button type="button" class="bg-yellow-400 text-white py-2 px-4 rounded ml-4 shadow hover:bg-orange-500 duration-200" ><i class="fas fa-star"></i> Send Rate </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($menu_tomorrow == null)

            @else

            <div class="flex gap-4 ml-0 md:ml-2 md:mt-0 mt-4 text-gray-500">
                <div><img src="{{ url('public/'.$menu_tomorrow->menu->photos->random()->file)}}" class="object-cover h-28 w-28 rounded opacity-75 hover:opacity-100"></div>
                <div> 
                    <div class="flex-col gap-4">
                        <b class="text-lg">
                            Tomorrow Breakfast
                        </b>
                        <div>
                        {{$menu_tomorrow->menu->name}}
                        </div>
                        <div class="mt-4 ml-2">
                            <button type="button" class="bg-blue-400 text-white py-2 px-4 rounded hover:bg-blue-500 duration-200d disabled:opacity-50" disabled><i class="fas fa-feather-alt"></i>  Review</button>
                            <button type="button" class="bg-yellow-400 text-white py-2 px-4 rounded ml-4 shadow hover:bg-yellow-500 duration-200d disabled:opacity-50" disabled><i class="fas fa-star"></i> Send Rate </button>
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
              {{Carbon\Carbon::now()->format('F')}} Schedule
            </div>
            @php
                $start_date = $now->startOfMonth    ();
            @endphp
            @for($i = 1; $i <= $now->daysInMonth;$i++,$start_date->addDay())
            @php
                $order = $user->orders->where('order_date',$start_date->format('Y-m-d'))->first();
            @endphp
            <div class="flex items-center bg-gray-200 border-orange-500 gap-2 p-2 rounded border-l-4 mb-2">
                <div class="ml-2 text-xl text-blue-700 leading-7 font-bold bg-blue flex-initial">
                  {{$i}}
                </div>
            @if($order == null)
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

            <div class="p-4 rounded-xl bg-gradient-to-r from-purple-200 to-orange-200 shadow mb-4">
            <div class="flex items-center">
              <img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full">
                <div class="ml-2 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laravel.com/docs">Pizza & Pop Ice</a></div>
            </div>        
            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                  Awalnya lucu aja makan sesuatu yg hitam, tapi rasanya tetap seperti roti kok. Sama seperti menu pilihan pizza lainnya utk struktur rotinya. Mantab deh
                </div>           
                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>2h ago</div>                        
                    </div>           
            </div>
            </div>

            <div class="flex items-center rounded-xl bg-gradient-to-r from-purple-200 to-blue-200 shadow gap-2 p-4 rounded border-l-4 mb-4">
                <img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full flex-initial">
                
                <div class=" text-lg text-gray-700 leading-7 font-semibold flex-auto">
                    <a href="https://laravel.com/docs">Pizza & Pop Ice</a>
                      <div class="leading-tight text-sm font-base text-indigo-700">
                            2h ago                        
                    </div>     
                </div>

                  <div class="ml-2 text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-gray-100 p-1 px-2 rounded-xl">
                  <i class="fas fa-star"></i> 4.5
                </div>

            </div>

            <div class="p-4 rounded-xl bg-gradient-to-r from-purple-200 to-orange-200 shadow">
            <div class="flex items-center">
               <img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full">
                <div class="ml-2 text-lg text-gray-600 leading-7 font-semibold"><a href="https://laravel.com/docs">Pizza & Pop Ice</a></div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                  Awalnya lucu aja makan sesuatu yg hitam, tapi rasanya tetap seperti roti kok. Sama seperti menu pilihan pizza lainnya utk struktur rotinya. Mantab deh
                </div>           
                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                            <div>1 day ago</div>                        
                    </div>
               
            </div>
            </div>


        </div>
       
    </div>

</x-app-layout>