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
    			<th>Menu</th>
    			<th>Total Order</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($menu_today as $menu)
    		<tr>
    			<td>{{$menu->name}}</td>
    			<td>{{$menu->total_order}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>