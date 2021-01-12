<div class="min-h-screen  flex flex-col sm:justify-center items-center pt-0 md:pt-6  " style="background-image: linear-gradient(60deg,#575fcf,#4bcffa) !important;">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:w-4/5 h-screen sm:h-4/5 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg  shadow ">
        {{ $slot }}
    </div>
</div>
