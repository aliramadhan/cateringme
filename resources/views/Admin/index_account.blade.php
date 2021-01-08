<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{route('admin.create.account')}}">tambah account</a>
                <table class="table-auto w-full mx-auto">
                    <thead>
                        <tr>
                            <th class="bg-yellow-200" colspan="5">Employee</th>
                        </tr>
                        <tr class="bg-blue-200">
                            <th>No.</th>
                            <th>Pict</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($users->where('role','Employee') as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="table-auto w-full mx-auto mt-5">
                    <thead>
                        <tr>
                            <th class="bg-yellow-200" colspan="5">Catering</th>
                        </tr>
                        <tr class="bg-blue-200">
                            <th>No.</th>
                            <th>Pict</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($users->where('role','Catering') as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
