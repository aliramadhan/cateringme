<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Catering') }}
        </h2>
    </x-slot>
    <form action="{{route('admin.index.order_not_taken')}}" method="GET">
    @csrf
        <input type="date" @if($from != null) value="{{$from->format('Y-m-d')}}" @endif name="from">
        <input type="date" @if($to != null) value="{{$to->format('Y-m-d')}}" @endif name="to">
        <input type="submit" name="submit">
    </form>
    <table>
    	<thead>
            <tr>
                <th colspan="3">Period @if($from == null) {{$now->format('d F Y')}} @else {{$from->format('d F Y')}} - {{$to->format('d F Y')}} @endif </th>
            </tr>
    		<tr>
    			<th>No.</th>
                <th>Employee Name</th>
    			<th>Date</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($employees as $employee)
    		<tr>
    			<td>{{$loop->iteration}}</td>
                <td>{{$employee['employee']->name}}</td>
    			<td>{{$employee['date']}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>