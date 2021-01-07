<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('employee.store.order')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <h2>Dates</h2>
                    @for($i = 1; $i <= $dates; $i++, $month->addDay())
                        <input type="checkbox" name="dates[]" value="{{$month}}">{{$month->format('Y-m-d')}}<br>
                    @endfor
                    <h2>Menu</h2>
                    @foreach($menus as $menu)
                        <input type="radio" name="menu" value="{{$menu->menu_code}}">{{$menu->name}}<br>
                    @endforeach
                    <input type="submit" name="submit">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>