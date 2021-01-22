<x-app-layout>
   <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History Review Order') }}
        </h2>
    </x-slot>
<style type="text/css">
  .pagination-info{
    color: #fff;
  }
</style>
  <table class="w-full table min-w-full divide-y divide-gray-200 text-white text-center rounded-lg  table-dark table-borderless" 
  id="table"        
  data-locale="en-US"
  data-show-refresh="false"
  data-show-toggle="false"        
  data-show-columns="true"        
  data-show-export="true"
  data-click-to-select="true"
  data-toggle="table"
  data-search="true"
  data-detail-formatter="detailFormatter"
  data-page-list="[10, 25, 50, 100, all]"
  data-show-pagination-switch="false"
  data-pagination="true"
  data-minimum-count-columns="2"
  data-response-handler="responseHandler"
  data-export-types= "['excel','doc', 'txt']">

  <thead class="bg-gray-800 text-white uppercase font-semibold text-base font-semibold ">
    <tr>
      <th class="w-10">No.</th>
      <th>Date</th>
      <th>Menu</th>
      <th>Stars</th>
      <th>Review</th>
 </tr>
</thead>
<tbody class="text-center font-semibold tracking-wider">
 @for($i = 1, $start->subMonth(); $i <= $now->daysInMonth; $i++, $start->addDay())
 @php
 $review = auth()->user()->orders->where('review_at',$start->format('Y-m-d'))->first();
  if($review == null){
    continue;
  }
 @endphp
 <tr>
  <td>{{$i}}</td>
  <td>{{$start->format('d, M Y')}}</td>
  <td>@if($review != null) {{$review->menu->name}} @endif</td>
  <td>{{$review->stars}}</td>
  <td>{{$review->review}}</td>
</tr>
@endfor
</tbody>
</table>
<script src="{{asset('resources/js/myJs.js')}}"></script>
<script src="{{asset('resources/js/searching.js')}}"></script>
</x-app-layout>
