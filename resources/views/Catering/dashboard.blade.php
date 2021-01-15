<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard ') }}
        </h2>
    </x-slot>

     <div class="p-6 border-b border-gray-200">
       
        <div class="w-full px-8">
            <div class="-mx-2 md:flex">
                <div class="w-full md:w-full px-2">
                    <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                            <div class="px-3 py-24 text-center relative z-10">
                                <h4 class="text-xl uppercase text-gray-500 leading-tight"> My Catering Scores</h4>
                                <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">
                                    <i class="fas fa-star"></i> 5 Rate</h3>
                                <p class="text-lg text-green-500 leading-tight">50 % ▲</p>
                            </div>
                            <div class="absolute bottom-0 inset-x-0">
                                <canvas id="chart1" height="300"></canvas>
                            </div>
                        </div>
                    </div> 
                    <div class="flex gap-4">
                        <div class="w-full md:w-1/2 ">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 py-16 text-center relative z-10">
                                    
                                    <h3 class="text-5xl text-orange-700 font-semibold leading-tight my-2">
                                        4</h3>
                                    <h4 class="text-xl uppercase text-gray-500 leading-tight"> Catering Menu</h4>
                                </div>                                
                            </div>
                        </div>                    
                    </div>
                     <div class="w-full md:w-1/2 ">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 py-16 text-center relative z-10">
                                    <h3 class="text-5xl text-green-500 font-semibold leading-tight my-2">
                                        1</h3>
                                    <h4 class="text-xl uppercase text-gray-500 leading-tight"> Menu Active</h4>
                                </div>
                               
                            </div>
                        </div>                    
                    </div> 
                     <div class="w-full md:w-1/2 ">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 py-16 text-center relative z-10">
                                   
                                    <h3 class="text-5xl text-gray-700 font-semibold leading-tight my-2">
                                         5 </h3>
                                     <h4 class="text-xl uppercase text-gray-500 leading-tight"> Total Review</h4>
                                </div>
                               
                            </div>
                        </div>                    
                    </div> 
                    </div>

                </div>
                
                  <div class="w-full md:w-3/4 px-2">
                    <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-orange-400 shadow-lg md:shadow-xl relative overflow-hidden" style="background-color: #8EC5FC;
                        background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
                        ">
                         <div class="py-4 text-center relative z-10 text-gray-700 ">
                             <h3 class="text-2xl font-bold leading-tight mb-5">Food Ranking</h3>
                                  <div class="flex font-semibold text-lg mb-2 items-center px-3 ">
                                  <div class="w-10">
                                   1.
                                  </div>                                    
                                  <div class="flex-auto text-left">
                                    Pizza Keju Coklat
                                  </div>      
                                    <div class=" text-base font-base mr-1">(200 Review) 
                                    </div> 
                                  <div class=" text-lg text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl">
                                    <i class="fas fa-star"></i> 4.5
                                </div>                             
                                </div>  
                                <?php for ($i=2; $i < 11; $i++) { 
                                    # code...
                                ?>
                                  <div class="flex font-semibold text-lg mb-2 items-center px-3 ">
                                  <div class="w-10">
                                  {{$i}}
                                  </div>                                    
                                  <div class="flex-auto text-left">
                                    Pizza Keju Coklat
                                  </div>      
                                    <div class=" text-base font-base mr-1">(200 Review) 
                                    </div> 
                                  <div class=" text-lg text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl">
                                    <i class="fas fa-star"></i> 4.5
                                </div>                             
                                </div>
                                 <?php  } ?>
                                
                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="p-6 mt-6">       
        <div class="col-span-2 text-2xl text-center mb-6 font-base">          
          My Catering Feed & Review
        </div>
       
        <div class=" rounded-xl bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex ">
              <div class="flex flex-row text-base absolute bg-gray-600 absolute rounded-tl-xl rounded-br-xl text-white px-4 hover:bg-gray-700 duration-500 cursor-pointer">
                  <div class="px-2 py-1 font-semibold ">Pizza Keju Coklat</div>                 
                </div>
          <img src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2020/06/11/3650390209.jpg" class="object-cover flex-none bg-cover h-48 lg:h-auto lg:w-52 overflow-hidden rounded-l-lg">
          <div class="flex flex-col py-3 px-6 flex-auto">
            <div class="flex items-center">           
              <div class=" text-lg flex-auto text-gray-600 leading-7 font-semibold flex items-center">
                 <img src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2020/06/11/3650390209.jpg" class="object-cover h-10 w-10 rounded-full">
                 <div class="ml-2">
                    <a href="#">Jack</a>
                    <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                      2 hour ago
                  </div>
                </div>
              </div>
              <div class=" text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl">
                <i class="fas fa-star"></i> 4.5
              </div>
            </div>        
            <div >
              <div class="mt-2 text-sm text-gray-500">
                Ntabss lurr
              </div>           
              <div class="mt-3 flex items-center">

              </div>
            </div>
          </div>
        </div>
        
        <div class=" rounded-xl bg-gradient-to-r from-white to-purple-50 shadow mb-4 flex flex-row-reverse">
          <div class="flex flex-row text-base absolute bg-gray-600 absolute rounded-tr-xl rounded-bl-xl text-white px-4 hover:bg-gray-700 duration-500 cursor-pointer">
              <div class="px-2 py-1 font-semibold ">Pizza Keju Coklat</div>                 
          </div>
          <img src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2020/06/11/3650390209.jpg" class="object-cover flex-none bg-cover h-48 lg:h-auto lg:w-52 overflow-hidden rounded-r-lg">
          <div class="flex flex-col py-3 px-6 flex-auto flex-row-reverse">
            <div class="flex flex-row-reverse items-center">           
              <div class=" text-lg flex-auto text-gray-600 leading-7 font-semibold flex items-center flex-row-reverse text-right">
                 <img src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2020/06/11/3650390209.jpg" class="object-cover h-10 w-10 rounded-full">
                 <div class="mr-2">
                    <a href="#">Jack</a>
                    <div class=" text-sm font-semibold text-indigo-700 -mt-2">
                      2 hour ago
                  </div>
              </div>
          </div>
              <div class=" text-xl text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl">
                <i class="fas fa-star"></i> 4.5
            </div>
            </div>        
            <div >
              <div class="mt-2 text-sm text-gray-500 text-right">
                Ntabss lurr
            </div>           
            <div class="mt-3 flex items-center">

            </div>
        </div>
        </div>
        </div>
        <div class="w-full text-center  animate transform transition-transform hover:translate-y-1 duration-1000">
          <a href="#kemanaya" class="bg-gray-700 px-6 py-2 rounded-lg  shadow-lg text-white opacity-75 transform hover:opacity-100  focus:border-gray-200 hover:translate-x-2  "> Show More</a>
        </div>
      </div>


    <table>
    	<thead>
    		<tr>
    			<th>Menu</th>
    			<th>Total Order Today</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($menu_today as $menu)
    		<tr>
    			<td>{{$menu->name}}</td>
    			<td>{{$menu->total_order}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="{{asset('resources/js/stat.js')}}"></script>
</x-app-layout>