<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    @for($i = 1; $i <= $now->daysInMonth; $i++, $start->addDay())
                        @php
                            $schedule = App\Models\ScheduleMenu::where('date',$start->format('Y-m-d'))->first();
                            $order = App\Models\Order::where('order_date',$start->format('Y-m-d'))->first();
                        @endphp
                        <input type="checkbox" name="dates[]" @if($schedule == null) disabled @endif value="{{$start->format('Y-m-d')}}"> {{$start->format('Y-m-d')}} <br>
                        @if($schedule != null)
                            @foreach(explode(",", $schedule->menu_list) as $menu)
                                @php
                                    $menu = App\Models\Menu::where('id',$menu)->first();
                                @endphp
                                <input type="radio" name="{{$i}}" value="{{$menu->id}}"> {{$menu->name}}
                            @endforeach

                            <br>
                        @endif
                    @endfor
                    <input type="submit" name="submit">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>