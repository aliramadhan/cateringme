<x-app-layout>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choose Month') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach($months as $month)
                    <a href="{{route('employee.create.order',$month->format('Y-m-d'))}}">{{$month->format('F Y')}}</a><br>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>