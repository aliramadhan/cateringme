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
	<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
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
					<p class="text-2xl font-bold">Simple Modal!</p>
					<div class="modal-close cursor-pointer z-50">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
					</div>
				</div>

				<!--Body-->
				<p>Modal content can go here</p>
				<p>...</p>
				<p>...</p>
				<p>...</p>
				<p>...</p>

				<!--Footer-->
				<div class="flex justify-end pt-2">
					<button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
					<button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
				</div>

			</div>
		</div>
	</div>



	<div class="p-6 border-b border-gray-200">
		<div class="col-span-2 text-2xl text-center mb-6 font-base">          
			Statistic Today
		</div>
		<div class="w-full ">
			<div class="-mx-2 md:flex">
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
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
					</div>
				</div>
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
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
							<p class="leading-tight text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, quaerat?</p>
						</div>
						<div class="col-start-5 col-end-6 mx-auto relative">
							<div class="h-full w-6 flex items-center justify-center">
								<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
							</div>
							<div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow my-4 ml-auto"></div>        
						</div>
						<div class="col-start-6 col-end-10 text-left relative text-black my-auto animate transform transition-transform hover:translate-x-2 
						duration-1000">
							<h3 class="font-semibold text-lg mb-1">Burger And Pizza</h3>
							<p class="leading-tight text-justify">10.00, 3 Jan</p>     
						</div>


					</div>
				@else
					<!-- right -->
					<div class="contents">
							<div class="col-start-1 col-end-5 text-right relative text-black my-auto animate transform transition-transform hover:-translate-x-2 
							duration-1000">
							<h3 class="font-semibold text-lg mb-1">{{$review->menu->name}}</h3>
							<p class="leading-tight ">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, Y-m-d')}}</p>     
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
				<!-- delok kabeh -->
				<div class="contents">
					<div class="col-start-5 col-end-6 mx-auto relative">
						<div class="h-full w-6 flex items-center justify-center">
							<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
						</div>

					</div>
					<a href="{{route('admin.index.review')}}" class="contents cursor-pointer">
						<div class="bg-gray-500 col-start-4 col-end-7 p-4 rounded-xl my-4 mr-auto shadow-md animate transform transition-transform hover:translate-y-2 hover:bg-gray-700 duration-1000 w-full text-center cursor-pointer">

							<h3 class="font-semibold text-lg mb-1">See More</h3>	

						</div>
					</a>	
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
				<div class="bg-cover bg-top  rounded-t-xl bg-center h-auto text-white pt-24 pb-10 px-10 object-fill" style="background-image: url({{url('public/'.$menu->photos->first()->file)}})">
					<div class=" p-4 rounded-lg" style="  background: #3e3e3eba;">
						<p class="font-bold text-sm uppercase mb-1">@if($loop->iteration == 1) First Menu @else Second Menu @endif</p>
						<p class="text-3xl font-bold mb-6">{{$menu->name}}</p>
						<p class="text-2xl mb-4 leading-none h-52 overflow-ellipsis overflow-hidden">{{$menu->desc}} </p>
						<a href="{{route('admin.index.menu')}}" class="ml-1 rounded-lg font-semibold bg-purple-500 text-white px-4 py-2 hover:bg-purple-700 duration-1000">Manage</a>
					</div>
					
				</div> <!-- container -->

			</div>
			@endforeach
		</div>
		<div  class="flex justify-between w-12 mx-auto py-2">
			<button id="sButton1" onclick="sliderButton1()" class="bg-purple-400 rounded-full w-4 pb-2 " ></button>
			<button id="sButton2" onclick="sliderButton2() " class="bg-purple-400 rounded-full w-4 p-2"></button>
		</div>
	</div>

	<div class="col-span-2 text-center mt-6 font-base bg-white rounded-xl py-6">       
	<p class="text-3xl font-bold text-green-500 mb-4">Our Report</p>   
		

		<div class=" p-4 cursor-default flex  border-b-2  border-gray-200">
			<img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full mr-3  my-auto">
			<div class="text-base flex-auto text-left">
				<h3 class="font-semibold text-lg mb-1">Schedule Files</h3>
				<p class="leading-tight ">January 2020</p>
			</div>
			<button class="bg-green-500 py-1 px-4 text-2xl text-white rounded-lg  animate transform transition-transform hover:translate-y-2 hover:bg-green-700 duration-1000">
				<i class="fas fa-file-download"></i>
			</button>
		</div>
		<div class=" p-4  a cursor-default flex  border-b-2  border-gray-200">
			<img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full mr-3  my-auto">
			<div class="text-base flex-auto text-left">
				<h3 class="font-semibold text-lg mb-1">Employee Files</h3>
				<p class="leading-tight ">January 2020</p>
			</div>
			<button class="bg-green-500 py-1 px-4 text-2xl text-white rounded-lg  animate transform transition-transform hover:translate-y-2 hover:bg-green-700 duration-1000">
				<i class="fas fa-file-download"></i>
			</button>
		</div>
		<div class=" p-4  a cursor-default flex  border-b-2  border-gray-200">
			<img src="{{ asset('/resources/image/burger.jpg')}}" class="object-cover h-10 w-10 rounded-full mr-3  my-auto">
			<div class="text-base flex-auto text-left">
				<h3 class="font-semibold text-lg mb-1">Calculation Files</h3>
				<p class="leading-tight ">January 2020</p>
			</div>
			<button class="bg-green-500 py-1 px-4 text-2xl text-white rounded-lg  animate transform transition-transform hover:translate-y-2 hover:bg-green-700 duration-1000">
				<i class="fas fa-file-download"></i>
			</button>
		</div>
	</div>
	


</div>



</div>
<script src="{{asset('resources/js/slider.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="{{asset('resources/js/stat.js')}}"></script>

</x-app-layout>