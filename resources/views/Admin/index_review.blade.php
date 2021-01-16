<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Review') }}
        </h2>
    </x-slot>
    <form action="{{route('admin.index.review')}}" method="GET">
    @csrf
        <input type="date" @if($from != null) value="{{$from->format('Y-m-d')}}" @endif name="from">
        <input type="date" @if($to != null) value="{{$to->format('Y-m-d')}}" @endif name="to">
        <input type="submit" name="submit">
    </form>
    <table>
    	<thead>
            <tr>
                <th colspan="6">Period @if($from == null) All time @else {{$from->format('d F Y')}} - {{$to->format('d F Y')}} @endif </th>
            </tr>
    		<tr>
    			<th>No.</th>
    			<th>Employee Name</th>
    			<th>Menu</th>
    			<th>Review</th>
    			<th>Rate</th>
                <th>Order date</th>
    			<th>Reviewed at</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($reviews as $review)
    		<tr>
    			<td>{{$loop->iteration}}</td>
    			<td>{{$review->employee->name}}</td>
    			<td>{{$review->menu->name}}</td>
    			<td>{{$review->review}}</td>
    			<td><i class="fas fa-star"></i>{{$review->stars}}</td>
                <td>{{Carbon\Carbon::parse($review->order_date)->format('d F Y')}}</td>
    			<td>{{$review->reviewed_at}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>