<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>
    
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('
Create Catering Schedule') }}
        </h2>
    </x-slot>
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
                 <div class="relative h-screen ">
                    <div class="absolute inset-0 w-full h-full bg-pink-500 text-white flex items-center justify-center text-5xl transition-all ease-in-out duration-1000 transform translate-x-0 slide">

                     @foreach($months as $month)
                    <a href="{{route('employee.create.order',$month->format('Y-m-d'))}}">{{$month->format('F Y')}}</a>
                    <br>
                         @endforeach
                    </div>
                    <div class="absolute inset-0 w-full h-full bg-purple-500 text-white flex items-center justify-center text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide">There</div>
                    <div class="absolute inset-0 w-full h-full bg-teal-500 text-white flex items-center justify-center text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide">Booya!</div>

                    <div onclick="nextSlide()" class="absolute bottom-10 right-10 bg-white w-16 h-16 flex items-center justify-center text-black cursor-pointer">&#x276F;</div>
                    <div onclick="previousSlide()" class="absolute bottom-10 right-10 bg-white w-16 h-16 mr-16 border-r border-gray-400 flex items-center justify-center text-black cursor-pointer">&#x276E;</div>
                </div>
            
              
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function nextSlide(){
    let activeSlide = document.querySelector('.slide.translate-x-0');
    activeSlide.classList.remove('translate-x-0');
    activeSlide.classList.add('-translate-x-full');
    
    let nextSlide = activeSlide.nextElementSibling;
    nextSlide.classList.remove('translate-x-full');
    nextSlide.classList.add('translate-x-0');
}

function previousSlide(){
    let activeSlide = document.querySelector('.slide.translate-x-0');
    activeSlide.classList.remove('translate-x-0');
    activeSlide.classList.add('translate-x-full');
    
    let previousSlide = activeSlide.previousElementSibling;
    previousSlide.classList.remove('-translate-x-full');
    previousSlide.classList.add('translate-x-0');
}
    </script>
</x-app-layout>