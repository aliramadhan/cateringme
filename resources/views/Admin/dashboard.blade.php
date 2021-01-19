<x-app-layout>

	@if($errors->any())
	{{ implode('', $errors->all('<div>:message</div>')) }}
	@endif

	
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard Admin') }}
		</h2>
	</x-slot>
	<!--Modal-->
<<<<<<< HEAD

=======
	

	<form action="{{route('admin.update.menu_prize')}}" method="POST">
	@csrf
	<input type="number" name="prize">
	<input type="submit" name="submit">
	</form>
>>>>>>> origin/master
	<div class="p-6 border-b border-gray-200" style="background-color: #0093E9;
	background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">
		<div class="col-span-2 text-2xl text-center mb-6 font-semibold text-white">          
			Statistic Today
		</div>
		<div class="w-full ">
			<div class="-mx-2 md:flex">
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
						<a href="{{route('admin.index.order')}}">
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
								<h4 class="text-sm uppercase text-gray-500 leading-tight">Catering Taken</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{$catering_taken}}</h3>
								<p class="text-xs @if($catering_taken > $subcatering_taken) text-green-500 @else text-red-500 @endif leading-tight">@if($catering_taken > $subcatering_taken) ▲ @else ▼ @endif {{$persen_catering_taken}} %</p>
							</div>
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart1" height="70"></canvas>
							</div>
						</div>
						</a>
					</div>
				</div>
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
						<a href="{{route('admin.index.order_not_taken')}}">
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
								<h4 class="text-sm uppercase text-gray-500 leading-tight">Catering not Taken</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{$not_taken}}</h3>
								<p class="text-xs @if($not_taken > $subnot_taken) text-green-500-500  @else text-red-500  @endif  leading-tight">@if($not_taken > $subnot_taken) ▲ @else ▼ @endif {{$persen_not_taken}}%</p>
							</div>
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart2" height="70"></canvas>
							</div>
						</div>
						</a>
					</div>
				</div>
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
								<h4 class="text-sm uppercase text-gray-500 leading-tight">Catering Quota</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">8,028</h3>
								<p class="text-xs text-green-500 leading-tight">▲ 8.2%</p>
							</div>
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart3" height="70"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
								<h4 class="text-sm uppercase text-gray-500 leading-tight">Rate & Review</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">8,028</h3>
								<p class="text-xs text-green-500 leading-tight">▲ 100%</p>
							</div>
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart4" height="70"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


	<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 ">
		<div class="p-6 mt-6">       
			<div class="col-span-2 text-2xl text-center mb-6 font-base">          
				Employees Feed & Review
			</div>

			<div class="grid grid-cols-9 mx-auto p-2 text-blue-50">
				@foreach($reviews as $review)
				@if($review->review == null)
					@php continue; @endphp
				@endif
				@if($loop->iteration % 2 == 0)
					<!-- left -->
					<div class="contents">
						<div class="bg-blue-500 col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md animate transform transition-transform hover:-translate-x-2 cursor-default duration-1000">
							<img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full mx-auto">
							<h3 class="font-semibold text-lg mb-1 text-center">{{$review->employee->name}}</h3>
							<p class="leading-tight text-justify">{{$review->review}}</p>
						</div>
						<div class="col-start-5 col-end-6 mx-auto relative">
							<div class="h-full w-6 flex items-center justify-center">
								<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
							</div>
							<div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow my-4 ml-auto"></div>        
						</div>
						<div class="col-start-6 col-end-10 text-left relative text-black my-auto animate transform transition-transform hover:translate-x-2 
						duration-1000">
							<h3 class="font-semibold text-lg mb-1">{{$review->menu->name}}</h3>
							<p class="leading-tight text-justify">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}</p>     
						</div>


					</div>
				@else
					<!-- right -->
					<div class="contents">
							<div class="col-start-1 col-end-5 text-right relative text-black my-auto animate transform transition-transform hover:-translate-x-2 
							duration-1000">
							<h3 class="font-semibold text-lg mb-1">{{$review->menu->name}}</h3>
							<p class="leading-tight ">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}</p>     
						</div>
						<div class="col-start-5 col-end-6 mx-auto relative">
							<div class="h-full w-6 flex items-center justify-center">
								<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
							</div>
							<div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
						</div>
						<div class="bg-blue-500 col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md animate transform transition-transform hover:translate-x-2 cursor-default md:flex flex-row duration-1000">
							<img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full md:mr-3 mx-auto my-auto">
							<div>
								<h3 class="font-semibold text-lg mb-1">{{$review->employee->name}}</h3>
								<p class="leading-tight text-justify">{{$review->review}}</p>
							</div>
						</div>
					</div>
				@endif
				@endforeach

				 <span id="pc1" class="contents hidden"> 	<!-- dibagi 5:5 li -->

				 	@foreach($reviews as $review)
				@if($review->review == null)
					@php continue; @endphp
				@endif
				@if($loop->iteration % 2 == 0)
				
					<div class="contents">
						<div class="bg-blue-500 col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md animate transform transition-transform hover:-translate-x-2 cursor-default duration-1000">
							<img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full mx-auto">
							<h3 class="font-semibold text-lg mb-1 text-center">{{$review->employee->name}}</h3>
							<p class="leading-tight text-justify">{{$review->review}}</p>
						</div>
						<div class="col-start-5 col-end-6 mx-auto relative">
							<div class="h-full w-6 flex items-center justify-center">
								<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
							</div>
							<div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow my-4 ml-auto"></div>        
						</div>
						<div class="col-start-6 col-end-10 text-left relative text-black my-auto animate transform transition-transform hover:translate-x-2 
						duration-1000">
							<h3 class="font-semibold text-lg mb-1">{{$review->menu->name}}</h3>
							<p class="leading-tight text-justify">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}</p>     
						</div>


					</div>
				@else
					<!-- right -->
					<div class="contents">
							<div class="col-start-1 col-end-5 text-right relative text-black my-auto animate transform transition-transform hover:-translate-x-2 
							duration-1000">
							<h3 class="font-semibold text-lg mb-1">{{$review->menu->name}}</h3>
							<p class="leading-tight ">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}</p>     
						</div>
						<div class="col-start-5 col-end-6 mx-auto relative">
							<div class="h-full w-6 flex items-center justify-center">
								<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
							</div>
							<div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
						</div>
						<div class="bg-blue-500 col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md animate transform transition-transform hover:translate-x-2 cursor-default md:flex flex-row duration-1000">
							<img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full md:mr-3 mx-auto my-auto">
							<div>
								<h3 class="font-semibold text-lg mb-1">{{$review->employee->name}}</h3>
								<p class="leading-tight text-justify">{{$review->review}}</p>
							</div>
						</div>
					</div>
				@endif
				@endforeach
				 </span>

				<!-- delok kabeh -->
				<div class="contents">
					<div class="col-start-5 col-end-6 mx-auto relative">
						<div class="h-full w-6 flex items-center justify-center">
							<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
						</div>

					</div>

					<button onclick="pcsh1()" class="contents cursor-pointer" id="pc2">
						<div class="bg-gray-500 col-start-4 col-end-7 px-14 py-2 rounded-3xl my-4 mr-auto shadow-md animate transform transition-transform hover:translate-y-2 hover:bg-gray-700 duration-1000 text-center mx-auto cursor-pointer">

							<h3 class="font-semibold "><i class="fas fa-chevron-down text-4xl"></i></h3>					

						</div>
					</button>	

					<div class="hidden contents " id="pc3">
						<button onclick="pcsh1()" class="contents cursor-pointer">
							<div class="bg-gray-500 col-start-4 col-end-7 px-14 py-2 rounded-3xl my-4 mr-auto shadow-md animate transform transition-transform hover:-translate-y-2 hover:bg-gray-700 duration-1000 mx-auto text-center cursor-pointer">

								<h3 class="font-semibold "><i class="fas fa-chevron-up text-4xl"></i></h3>	

							</div>
						</button>
						<a href="{{route('admin.index.review')}}" class="contents cursor-pointer">
							<div class="bg-orange-500 col-start-4 col-end-7 p-4 rounded-xl my-4 mr-auto shadow-md animate transform transition-transform hover:translate-y-2 hover:bg-orange-700 duration-1000 w-full text-center cursor-pointer">

								<h3 class="font-semibold text-lg mb-1">See All</h3>	

							</div>
						</a>	
					</div>
				</div>
			</div>
		</div>

<div class="p-6 mt-6">       
	<div class="col-span-2 text-2xl text-center mb-6 font-base">          
		Catering Menu
	</div>
	<div class="bg-white mb-4 rounded-xl shadow-lg">
		<div class="sliderAx h-auto   ">
			@foreach($menus as $menu)
			<div id="slider-{{$loop->iteration}}" class="container mx-auto ">
				
                  <div class="px-6 py-2 font-semibold absolute bg-gray-600 rounded-tl-xl rounded-br-xl text-white hover:bg-gray-700 duration-500 cursor-pointer text-2xl"><i class="fas fa-cog"></i></div>                
                
				<div class="bg-cover bg-top  rounded-xl bg-center h-auto text-white pt-24 pb-10 px-10 object-fill" style="background-image: url({{url('public/'.$menu->photos->first()->file)}})">
					
					<div class=" p-4 rounded-lg" style="  background: #3e3e3eba;">
						<p class="font-bold text-sm uppercase mb-1">@if($loop->iteration == 1) First Menu @else Second Menu @endif</p>
						<div class="flex items-center mb-6">
							<p class="text-3xl font-bold  uppercase mr-2">{{$menu->name}}</p>
							<div class=" text-lg text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border border-orange-300 p-1 px-2 rounded-xl">
								<i class="fas fa-star"></i> 2
							</div>   
						</div>
						<p class="text-xl mb-4 leading-none overflow-ellipsis overflow-hidden h-20">{{$menu->desc}} </p>
						
					</div>
					
				</div> <!-- container -->

			</div>
			@endforeach
		</div>
	
	</div>

	<div class="col-span-2 text-center mt-6 font-base bg-white rounded-xl py-6">       
	<p class="text-3xl font-bold text-green-500 mb-4">Our Report</p>
		@foreach($orders as $order)
		<div class=" p-4 cursor-default flex  border-b-2  border-gray-200">
			<img src="{{ url('public/'.$order->menu->photos->random()->file)}}" class="object-cover h-10 w-10 rounded-full mr-3  my-auto">
			<div class="text-base flex-auto text-left">
				<h3 class="font-semibold text-lg mb-1">{{$order->employee->name}}</h3>
				<p class="leading-tight ">{{$order->menu->name}}</p>
			</div>
			@if($now->format('H') >= 9 )
			<p>Served</p>
			@endif
		</div>
		@endforeach
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
<script src="{{asset('resources/js/slider.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="{{asset('resources/js/stat.js')}}"></script>

</x-app-layout>