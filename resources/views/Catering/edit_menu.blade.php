<x-app-layout>

    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Catering') }}
        </h2>
    </x-slot>
    <form action="{{route('catering.update.menu',$menu->menu_code)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <input type="text" name="name" value="{{$menu->name}}">
        <textarea name="desc">{{$menu->desc}}</textarea>
        @foreach($menu->photos as $photo)
        <img src="{{url('public/'.$photo->file)}}" width="200px">
        <input type="file" name="{{$photo->id}}" accept="image/x-png,image/gif,image/jpeg">    
        <a href="{{route('catering.check.photo',$photo->id)}}">Delete {{$photo->id}}
        </a>
        @endforeach
        <br>
        <input type="submit" name="submit">
    </form>

</x-app-layout>
