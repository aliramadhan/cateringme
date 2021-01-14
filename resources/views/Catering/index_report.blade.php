<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Catering') }}
        </h2>
    </x-slot>
    <form action="{{route('catering.index.report')}}">
    @csrf
        <input type="month" name="month" @if(request()->month) value="{{request()->month}}" @endif>
        <input type="submit" name="submit">
    </form>
    <table>
    	<thead>
    		<tr>
    			<th>No.</th>
    			<th>Menu</th>
                <th>Qty Order</th>
                <th>Qty Served</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($user->menus as $menu)
            @php
                $qty = $menu->orders->count();
                $start = Carbon\Carbon::parse(request()->month)->startOfMonth();
                $stop = Carbon\Carbon::parse(request()->month)->endOfMonth();
                $now = Carbon\Carbon::now();
                $served = $menu->orders()->where('order_date','<=', $now->format('Y-m-d'))->count();
                if(request()->month != null){
                    $qty = $menu->orders()->whereBetween('order_date',[$start,$stop])->count();
                    if($now < $stop){
                        $served = $menu->orders()->whereBetween('order_date',[$start,$now])->count();
                    }
                    else{
                        $served = $menu->orders()->whereBetween('order_date',[$start,$stop])->count();
                    }
                }
            @endphp
    		<tr>
    			<td>{{$loop->iteration}}</td>
    			<td>{{$menu->name}}</td>
                <td>{{$qty}}</td>
                <td>{{$served}}</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</x-app-layout>