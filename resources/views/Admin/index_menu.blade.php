<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Account') }}
        </h2>
    </x-slot>

    @if (session('message'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <div class="py-12">
        <form action="{{route('admin.scheduled.menu')}}" method="POST">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-auto w-full mx-auto">
                    <thead>
                        <tr class="bg-blue-200">
                            <th>No.</th>
                            <th>Name</th>
                            <th>Catering</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->catering->name}}</td>
                                <td><input class="schedule-menu" type="checkbox" name="show[]" value="{{$menu->menu_code}}" @if($menu->show == 1) checked @endif></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <input type="submit" name="submit">
        </form>
    </div>
</x-app-layout>
<script type="text/javascript">
    $('.schedule-menu').on('change', function (e) {
        if($('.schedule-menu:checked').length > 2) {
            $(this).prop('checked', false);
            alert("allowed only 2");
        }
    });
</script>
