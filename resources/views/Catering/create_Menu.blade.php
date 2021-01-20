<x-guest-layout> 
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <form method="POST" action="{{ route('catering.store.menu') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Menu Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="photo" value="{{ __('Photo') }}" />
                <x-jet-input id="photo" class="block mt-1 w-full" type="file" accept="image/x-png,image/gif,image/jpeg" name="photo[]" :value="old('photo')" required multiple />
            </div>
            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <textarea class="form-textarea block mt-1 w-full" name="desc">{{old('desc')}}</textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Submit') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
