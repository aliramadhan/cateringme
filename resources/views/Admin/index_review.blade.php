<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Catering') }}
        </h2>
    </x-slot>
    <table>
    	<thead>
    		<tr>
    			<th>No.</th>
    			<th>Employee Name</th>
    			<th>Menu</th>
    			<th>Review</th>
    			<th>Rate</th>
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
    			<td>{{$review->reviewed_at}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>