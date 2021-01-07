<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{route('catering.create.menu')}}">tambah menu</a>
                <table class="table-auto w-full mx-auto">
                    <thead>
                        <tr class="bg-blue-200">
                            <th>No.</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($menus as $menu)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><img class="object-none h-48 w-full" src="{{url('public/'.$menu->photos->first()->file)}}"></td>
                            <td>{{$menu->name}}</td>
                            <td>{{$menu->desc}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>