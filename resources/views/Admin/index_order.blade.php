<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Catering') }}
        </h2>
    </x-slot>
    <form action="{{route('admin.index.order')}}" method="GET">
    @csrf
        <input type="date" @if($from != null) value="{{$from->format('Y-m-d')}}" @endif name="from">
        <input type="date" @if($to != null) value="{{$to->format('Y-m-d')}}" @endif name="to">
        <input type="submit" name="submit">
    </form>
    <table>
    	<thead>
            <tr>
                <th colspan="4">Period @if($from == null) {{$now->format('d F Y')}} @else {{$from->format('d F Y')}} - {{$to->format('d F Y')}} @endif </th>
            </tr>
    		<tr>
    			<th>No.</th>
    			<th>Employee Name</th>
    			<th>Menu</th>
                <th>Order Date</th>
    			<th>Status</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($orders as $order)
    		<tr>
    			<td>{{$loop->iteration}}</td>
    			<td>{{$order->employee->name}}</td>
                <td>{{$order->menu->name}}</td>
    			<td>{{$order->order_date}}</td>
                <td>Served</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>