<x-app-layout>

	<div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
	<div id="success" class="invisible absolute"></div>
	<div id="failure" class="invisible absolute"></div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
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
	<script type="text/javascript">
		chart.data.datasets[0].data[2] = 50;
	</script>
	
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard Admin') }}
		</h2>
	</x-slot>
	<!--Modal-->
	<form action="{{route('admin.update.menu_price')}}" method="POST">
	@csrf
 <div class="modal z-50 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
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
            <p class="text-2xl font-normal text-gray-600">Configuration <font class="text-orange-500">Catering Price</font></p>
            <div class="modal-close cursor-pointer z-50">
              <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
              </svg>
            </div>
          </div>

          <!--Body-->
          <div class="my-6">
          	<label for="price" class="block text-base font-medium text-gray-700">Price</label>
          	<div class="mt-1 relative rounded-md shadow-sm">
          		<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          			<span class="text-gray-500 sm:text-sm">
          				Rp.
          			</span>
          		</div>
          		<input type="text" name="price" id="price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full py-2 pl-10 text-base border-gray-300 rounded-md border" placeholder="0.00">
          		
          	</div>
          </div>
          
          <!--Footer-->
          <div class="flex justify-end pt-2">

            <button class=" px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
          </div>

        </div>
      </div>
    </div>
    </form>
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
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden hover:shadow-xl  animate transform transition-transform hover:-translate-y-2 duration-1000">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
								<h4 class="text-base font-semibold uppercase text-gray-500 leading-tight">Catering Taken</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{$catering_taken}}</h3>
								<p class="text-base animate-bounce @if($catering_taken > $subcatering_taken) text-green-500 @else text-red-500 @endif leading-tight">
								@if($catering_taken > $subcatering_taken) ▲ 
								@else ▼ @endif {{$persen_catering_taken}} %</p>
							</div>
							
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart1" ></canvas>
							</div>
						</div>
						</a>
					</div>
				</div>
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
						<a href="{{route('admin.index.order_not_taken')}}">
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden hover:shadow-xl  animate transform transition-transform hover:-translate-y-2 duration-1000">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
								<h4 class="text-base font-semibold uppercase text-gray-500 leading-tight">Catering not Taken</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{$not_taken}}</h3>
								<p class="text-base animate-bounce @if($not_taken > $subnot_taken) text-green-500-500  @else text-red-500  @endif  leading-tight">@if($not_taken > $subnot_taken) ▲ @else ▼ @endif {{$persen_not_taken}}%</p>
							</div>
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart2" height="70" style="height:100px !important;"></canvas>
							</div>
						</div>
						</a>
					</div>
				</div>
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden hover:shadow-xl  animate transform transition-transform hover:-translate-y-2 duration-1000">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
						<h4 class="text-base font-semibold uppercase text-gray-500 leading-tight">Catering Quota</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{\App\Models\User::where('role','Employee')->count()}}</h3>
								<p class="text-base animate-bounce text-green-500 leading-tight">-</p>		
							</div>
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart3" height="70" style="height:100px !important;"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="w-full md:w-1/3 px-2">
					<div class="rounded-lg shadow-sm mb-4">
						<a href="{{route('admin.index.review')}}">
						<div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden hover:shadow-xl  animate transform transition-transform hover:-translate-y-2 duration-1000">
							<div class="px-3 pt-8 pb-10 text-center relative z-10">
								<h4 class="text-base font-semibold uppercase text-gray-500 leading-tight">Rate & Review</h4>
								<h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{$orders->where('review','!=',null)->count()}}</h3>
								<p class="text-base animate-bounce text-green-500 leading-tight">-</p>
							</div>
							<div class="absolute bottom-0 inset-x-0">
								<canvas id="chart4" height="70" style="height:100px !important;"></canvas>
							</div>
						</div>
						</a>
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
				@if($loop->iteration < 5)
					@if($review->review == null)
						@php continue; @endphp
					@endif
					@if($loop->iteration % 2 == 0)
					<!-- left -->
					<div class="contents">
						<div class="bg-blue-500 col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md animate transform transition-transform hover:-translate-x-2 cursor-default duration-1000">
							<img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 w-10 rounded-full mx-auto">
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
							<p class="leading-tight text-justify">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}<br>{{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}</p>     
						</div>


					</div>
					@else
					<!-- right -->
					<div class="contents">
							<div class="col-start-1 col-end-5 text-right relative text-black my-auto animate transform transition-transform hover:-translate-x-2 
							duration-1000">
							<h3 class="font-semibold text-lg mb-1">{{$review->menu->name}}</h3>
							<p class="leading-tight ">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}<br>{{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}</p>     
						</div>
						<div class="col-start-5 col-end-6 mx-auto relative">
							<div class="h-full w-6 flex items-center justify-center">
								<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
							</div>
							<div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
						</div>
						<div class="bg-blue-500 col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md animate transform transition-transform hover:translate-x-2 cursor-default md:flex flex-row duration-1000">
							<img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 w-10 rounded-full md:mr-3 mx-auto my-auto">
							<div>
								<h3 class="font-semibold text-lg mb-1">{{$review->employee->name}}</h3>
								<p class="leading-tight text-justify">{{$review->review}}</p>
							</div>
						</div>
					</div>
					@endif
				@else
				 <span id="pc1" class="contents hidden"> 	<!-- dibagi 5:5 li -->
			 	
					@if($review->review == null)
						@php continue; @endphp
					@endif
					@if($loop->iteration % 2 == 0)
				
					<div class="contents">
						<div class="bg-blue-500 col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md animate transform transition-transform hover:-translate-x-2 cursor-default duration-1000">
							<img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 w-10 rounded-full mx-auto">
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
							<p class="leading-tight text-justify">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}<br>{{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}</p>     
						</div>


					</div>
					@else
					<!-- right -->
					<div class="contents">
							<div class="col-start-1 col-end-5 text-right relative text-black my-auto animate transform transition-transform hover:-translate-x-2 
							duration-1000">
							<h3 class="font-semibold text-lg mb-1">{{$review->menu->name}}</h3>
							<p class="leading-tight ">{{Carbon\Carbon::parse($review->reviewed_at)->format('H:s, d, M Y')}}<br>{{Carbon\Carbon::parse($review->reviewed_at)->diffForHumans()}}</p>     
						</div>
						<div class="col-start-5 col-end-6 mx-auto relative">
							<div class="h-full w-6 flex items-center justify-center">
								<div class="h-full w-1 bg-blue-800 pointer-events-none"></div>
							</div>
							<div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow"></div>
						</div>
						<div class="bg-blue-500 col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md animate transform transition-transform hover:translate-x-2 cursor-default md:flex flex-row duration-1000">
							<img src="@if($review->menu->photos->first() != null){{ url('public/'.$review->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 w-10 rounded-full md:mr-3 mx-auto my-auto">
							<div>
								<h3 class="font-semibold text-lg mb-1">{{$review->employee->name}}</h3>
								<p class="leading-tight text-justify">{{$review->review}}</p>
							</div>
						</div>
					</div>
					@endif
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
						<div class="bg-gray-500 col-start-3 col-end-8 px-14 py-2 rounded-3xl my-4 mr-auto shadow-md animate transform transition-transform hover:-translate-y-2 hover:bg-gray-700 duration-1000 mx-auto text-center cursor-pointer">

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
		<div class="bootstrapiso mb-4 rounded-xl shadow-lg">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner h-52 md:h-80">
				@foreach($menus as $menu)
				<div class="carousel-item @if($loop->iteration == 1) active @endif h-100">
					<img class="d-block w-100 h-96 rounded-xl" src="@if($menu->photos->first() != null ){{url('public/'.$menu->photos->random()->first()->file)}}  @else {{url('public/images/no-image.png')}} @endif" alt="First slide">
					<div class="carousel-caption text-left p-4 rounded" style="  background: #3e3e3eba;">						
						<p class="font-bold text-sm uppercase mb-1">Menu</p>						
						<div class="flex mb-6">
						<h2 class="text-xl font-bold uppercase my-auto">{{$menu->name}}</h2>
						<div class="ml-2 text-lg text-orange-500 leading-7 font-bold bg-blue flex-initial bg-white border  p-1 px-2 rounded-xl" style="border-color: #FF5A1F !important">
								<i class="fas fa-star"></i> {{$menu->orders->avg('stars')}}
							</div>   
						</div>
						<h5 class="fw-normal d-none d-md-block">{{$menu->desc}}</h5>

					</div>
				</div>

				@endforeach
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	
	

	<div class="col-span-2 gap-4  font-base rounded-xl py-6 flex items-center md:flex-row flex-col">  
		<div class="text-center mt-6 font-base bg-catering rounded-xl py-6 px-4 w-full" > 
			<p class="text-2xl font-normal text-white mb-4 text-left">Total Fee <span class="font-semibold">Today</span></p>
			<h4 class="text-4xl uppercase font-semibold text-white leading-tight">Rp. {{($orders->sum('fee'))}}</h4>
		</div>

		<div class="text-center mt-6 font-base bg-price rounded-xl py-6 px-4 w-full" > 
			<div class="flex">
				<p class="text-2xl font-semibold text-white mb-4 text-left flex-auto">Catering Price</p>
				<div id="modal-click" class="modal-open">
					<i class="fas fa-cog border rounded-full p-2 hover:border-orange-700 font-semibold text-gray-100 hover:text-orange-700 duration-500 cursor-pointer "></i></div>  
				</div>
				<h4 class="text-4xl uppercase font-semibold text-white leading-tight">Rp. {{($price)}}</h4>
			</div>

	</div>

	<div class="col-span-2 text-center mt-6 font-base bg-white rounded-xl py-6">       
	<p class="text-3xl font-bold text-green-500 mb-4">Our Report</p>
		@foreach($orders as $order)
		<div class=" p-4 cursor-default flex  border-b-2  border-gray-200">
			<img src="@if($order->menu->photos->first() != null) {{ url('public/'.$order->menu->photos->random()->file)}} @else {{url('public/images/no-image.png')}} @endif" class="object-cover h-10 w-10 rounded-full mr-3  my-auto">
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
