<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index Catering') }}
        </h2>
    </x-slot>
    <table>
    	<thead>
    		<tr>
    			<th>No.</th>
                <th>Employee Name</th>
    			<th>Menu</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($orders as $order)
    		<tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$order->employee->name}}</td>
    			<td>{{$order->menu->name}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>