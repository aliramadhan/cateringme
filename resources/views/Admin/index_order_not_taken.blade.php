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
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($employees as $employee)
    		<tr>
    			<td>{{$loop->iteration}}</td>
    			<td>{{$employee->name}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>