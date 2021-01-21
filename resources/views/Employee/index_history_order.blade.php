<x-app-layout>
   <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History Order') }}
        </h2>
    </x-slot>
    <form>
    @csrf
      <input type="month" name="month" min="2020-12" max="{{$now->format('Y-m')}}">
      <input type="submit" name="submit">
    </form>
    <table>
      <thead>
          <tr>
            <th>No.</th>
            <th>Date</th>
            <th>Menu</th>
          </tr>
      </thead>
      <tbody>
        @for($i = 1; $i <= $now->daysInMonth; $i++, $start->addDay())
          @php
            $order = auth()->user()->orders->where('order_date',$start->format('Y-m-d'))->first();
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$start->format('d, M Y')}}</td>
            <td>@if($order != null) {{$order->menu->name}} @endif</td>
          </tr>
        @endfor
      </tbody>
    </table>
</x-app-layout>
