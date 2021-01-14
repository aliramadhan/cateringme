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
    			<th>Menu</th>
    			<th>Qty Order</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($user->menus as $menu)
    		<tr>
    			<td>{{$loop->iteration}}</td>
    			<td>{{$menu->name}}</td>
    			<td>{{$menu->orders->count()}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>