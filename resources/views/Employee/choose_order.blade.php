

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>
    
    <style type="text/css">

        .label__checkbox {
          display: none;
      }

      .label__check {
          display:  inline-flex;

          width: 1em;
          height: 1em;
          cursor: pointer; 
          align-items: center;
          justify-content: center;
          transition: border 0.3s ease;

          i.icon {
            opacity: 0.2;  
            color: transparent;
            transition: opacity 0.3s 0.1s ease;
            -webkit-text-stroke: 3px rgba(0, 0, 0, 0.5);
        }

        &:hover {
            border: 5px solid rgba(0, 0, 0, 0.2);
        }
    }

    .label__checkbox:checked + .label__text .label__check {
      animation: check 0.5s cubic-bezier(0.1, 0.01, 0.1, 0.1) forwards;

      .icon {
        opacity: 1;
        transform: scale(0);
        color: white;
        -webkit-text-stroke: 0;
        animation: icon 0.3s cubic-bezier(1, 0.008, 0.565, 1.65) 0.1s 1 forwards;
    }
}


@keyframes icon {
  from {
    opacity: 0;
    transform: scale(0.3);
}
to {
    opacity: 1;
    transform: scale(1);
}
}

@keyframes check {
  0% {
    width: 1em;
    height: 1em;
    border-width: 5px;
}
10% {
    width: 1em;
    height: 1em;
    opacity: 0.1;
    background: rgba(0, 0, 0, 0.2);
    border-width: 15px;
}
12% {
    width: 1em;
    height: 1em;
    opacity: 0.4;
    background: rgba(0, 0, 0, 0.1);
    border-width: 0;
}
50% {
    width: 1em;
    height: 1em;
    background: #00d478;
    border: 1;
    opacity: 0.6;
}
100% {
    width: 1em;
    height: 1em;
    background: #00d478;
    border: 1;
    opacity: 1;
}
}
</style>

@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('
        Catering Schedule Formating') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto  lg:px-8">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
            <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
                <div class="flex-shrink min-w-0 flex items-center">
                  <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
                   Selection of dates for catering
               </h3>
           </div>
           <div class="ml-4 flex flex-shrink-0 items-center">
              <div class="flex items-center text-sm sm:hidden">
                <button type="button" onclick="previousSlide()" id="btn-slide-dis" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
                 <i class="fas fa-calendar-week"></i>
             </button>
             <button type="button" onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
                 <i class="fas fa-utensils"></i>
             </button>
         </div>
         <div class="hidden sm:flex items-center text-sm md:text-base">
            <button type="button" id="btn-slide-disx" onclick="previousSlide()"   class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600 ">
              Schedule
          </button>
          <button type="button" id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
            Food Menu
        </button>

    </div>
    <div class="hidden sm:flex sm:items-center">
        <div class="pl-4 pr-4 self-stretch">
          <div class="h-full border-l border-gray-200"></div>
      </div>
      <button type="button" @click="$refs[`${activeSnippet}ClipboardCode`].select(); document.execCommand('copy')" class="ml-3 text-gray-400 hover:text-gray-500" >
          <i class="fas fa-calendar-week"></i>
      </button>
  </div>
</div>
</div>

<div class="relative md:h-screen ">
    <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide" >


        <div class="grid grid-rows-7 gap-1 w-full">
         <div class=" text-2xl row-span-1">
             Choose Schedule
         </div>
         <div class="flex-row gap-2 row-span-2 px-4 sm:flex-col content-center text-center mb-8">

            <?php $m=1; ?>
            @foreach($months as $month)

            <!--  <a href="{{route('employee.create.order',$month->format('Y-m-d'))}}" class="flex-auto bg-orange-400 rounded-lg p-4 text-white font-base text-base hover:bg-orange-600 duration-1000" onchange="showUser(this.value)">{{$month->format('F')}}</a> -->

            <button class="flex-auto bg-orange-400 rounded-lg p-4 text-white font-base text-base hover:bg-orange-600 duration-1000 showSingle"  target="{{$m}}">{{$month->format('F')}}</button>
            <?php $m++; ?>
            @endforeach     


        </div>


        <div class="flex-row gap-2 row-span-3 px-4 mb-8">                       

            <div id="div1" class=" duration-1000 targetDiv bg-gray-200 justify-content content-center text-center rounded-lg"> 
                <h1 class="mb-4 text-center">January</h1>
                <?php
                for ($i=1; $i < 31; $i++) { 
                    ?>
                    <label class="label flex-auto  duration-1000">
                        <input class="label__checkbox  duration-1000" type="checkbox" value="<?php echo $i; ?>" name="cek<?php echo $i; ?>">
                        <span class="label__text font-base">
                          <span class="label__check p-4  bg-blue-400 rounded-lg text-white  hover:bg-orange-600 duration-1000 text-justify">
                            <i class="fa icon text-base font-bold absolute text-xl m-auto"><?php echo $i; ?></i>
                        </span>
                    </span>
                </label>
            <?php } 
            ?>
        </div>

        <div id="div12" class="hidden duration-1000 targetDiv bg-gray-200 justify-content content-center text-center rounded-lg"> 
            <h1 class="mb-4 text-center">December</h1>
            <?php
            for ($i=1; $i < 26 ; $i++) { 
                ?>
                <label class="label flex-auto  duration-1000">
                    <input class="label__checkbox  duration-1000" type="checkbox" value="<?php echo $i; ?>" name="cek<?php echo $i; ?>">
                    <span class="label__text font-base">
                        <span class="label__check p-4  bg-blue-400 rounded-lg text-white  hover:bg-orange-600 duration-1000">
                        <i class="fa icon text-base font-bold absolute "><?php echo $i; ?></i>
                    </span>
                </span>
            </label>
        <?php } 
        ?>
    </div>

    <div id="div5" class="hidden duration-1000 targetDiv bg-gray-200 justify-content content-center text-center rounded-lg"> 
        <h1 class="mb-4 text-center">May</h1>
        <?php
        for ($i=1; $i < 29 ; $i++) { 
            ?>
            <label class="label flex-auto  duration-1000">
                <input class="label__checkbox  duration-1000" type="checkbox" value="<?php echo $i; ?>" name="cek<?php echo $i; ?>">
                <span class="label__text font-base">
                    <span class="label__check p-4  bg-blue-400 rounded-lg text-white  hover:bg-orange-600 duration-1000">
                    <i class="fa icon text-base font-bold absolute "><?php echo $i; ?></i>
                </span>
            </span>
        </label>
    <?php } 
    ?>
</div>

</div>
<div class=" text-xl row-span-1 text-right pointer px-6">
   <button  onclick="nextSlide()" id="btn-slide-dis-2y" class="bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200"> Next  <i class="fas fa-arrow-right ml-2"></i></button>
</div>
</div>


</div>

<div class="absolute inset-0 w-full h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

  <div class="flex flex-col  ">
      <h3 class="flex-shrink min-w-0 font-regular text-2xl leading-snug truncate mb-5 text-center mt-2">
       Select Your Menu
   </h3>

   <div class="grid grid-cols-2 row-span-2 md:row-span-1 gap-12 w-full p-8">

      <div class=" text-2xl col-span-2 md:col-span-1">
        <button type="submit" class="hover:opacity-100 opacity-75 duration-500 transition ease-in-out rounded-xl  ">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-xl rounded-lg bg-pink-600"><img alt="..." src="{{asset('resources/image/burger.jpg')}}" class="w-full align-middle  rounded-t-lg"><blockquote class="relative p-8 mb-4"><svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height:95px;top:-94px"><polygon points="-30,95 583,95 583,65" class="text-pink-600 fill-current"></polygon></svg><h4 class="text-xl font-bold text-white">Burger with Soft Drinks</h4><p class="text-md font-light mt-2 text-white">The Arctic Ocean freezes                                    
            </p></blockquote></div>
        </button>
    </div>
    <div class=" text-2xl col-span-2 md:col-span-1">
        <button type="submit" class="hover:opacity-100 opacity-75 duration-500 transition ease-in-out rounded-xl  ">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-xl rounded-lg bg-blue-500"><img alt="..." src="https://asset.kompas.com/crops/X8-o4ZjKlJYAnnLnW0aeqlSwegs=/0x0:739x493/750x500/data/photo/2020/03/24/5e79ac7be84d3.jpg" class="w-full align-middle  rounded-t-lg"><blockquote class="relative p-8 mb-4"><svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height:95px;top:-94px"><polygon points="-30,95 583,95 583,65" class="text-blue-500 fill-current"></polygon></svg><h4 class="text-xl font-bold text-white">Pizza with Pop ez</h4><p class="text-md font-light mt-2 text-white">The Arctic Ocean freezes </p></blockquote></div>
        </button>
    </div>
</div>

<div class=" text-xl row-span-1 text-left pointer px-6">
   <button  onclick="previousSlide()" id="btn-slide-disy" class="ml-2 bg-gray-700 px-6 py-2 rounded-lg text-white opacity-75 hover:opacity-100 duration-1000 focus:border-gray-200"><i class="fas fa-arrow-left"></i> Back</button>
</div>

</div>

</div>




</div>


</div>
</div>
</div>


<script type="text/javascript">
    // Demo using plain javascript
    var button = document.getElementById("btn-slide-dis");
    var button2 = document.getElementById("btn-slide-dis-2");
    var button3 = document.getElementById("btn-slide-disx");
    var button4 = document.getElementById("btn-slide-dis-2x");
    var button6 = document.getElementById("btn-slide-disy");
    var button5 = document.getElementById("btn-slide-dis-2y");

    // Disable the button on initial page load
    button.disabled = true;
    button.style.backgroundColor ="#EEF2FF";
    button.style.color ="#528CE0";

    button3.disabled = true;   
    button3.style.backgroundColor ="#EEF2FF";
    button3.style.color ="#528CE0";

    //add event listener
    button.addEventListener('click', function(event) {
        button.disabled = true;
        button2.disabled = false;
        button2.style.backgroundColor ="";
        button2.style.color ="#9FA6B2";
        button.style.backgroundColor ="#EEF2FF";
        button.style.color ="#528CE0";

        button3.disabled = true ;
        button4.disabled = false;
        button3.style.backgroundColor ="#EEF2FF";
        button3.style.color ="#528CE0";
        button4.style.backgroundColor ="";
        button4.style.color ="#9FA6B2";

    });

    button2.addEventListener('click', function(event) {
        button2.disabled = true;
        button.disabled = false;
        button.style.backgroundColor ="";
        button.style.color ="#9FA6B2";
        button2.style.backgroundColor ="#EEF2FF";
        button2.style.color ="#528CE0";

        button4.disabled = true;
        button3.disabled = false;
        button3.style.backgroundColor ="";
        button3.style.color ="#9FA6B2";
        button4.style.backgroundColor ="#EEF2FF";
        button4.style.color ="#528CE0";

    });

    button3.addEventListener('click', function(event) {
     button3.disabled = true ;
     button4.disabled = false;
     button3.style.backgroundColor ="#EEF2FF";
     button3.style.color ="#528CE0";
     button4.style.backgroundColor ="";
     button4.style.color ="#9FA6B2";

     button.disabled = true;
     button2.disabled = false;
     button2.style.backgroundColor ="";
     button2.style.color ="#9FA6B2";
     button.style.backgroundColor ="#EEF2FF";
     button.style.color ="#528CE0";
 });

    button4.addEventListener('click', function(event) {
        button4.disabled = true;
        button3.disabled = false;
        button3.style.backgroundColor ="";
        button3.style.color ="#9FA6B2";
        button4.style.backgroundColor ="#EEF2FF";
        button4.style.color ="#528CE0";

        button2.disabled = true;
        button.disabled = false;
        button.style.backgroundColor ="";
        button.style.color ="#9FA6B2";
        button2.style.backgroundColor ="#EEF2FF";
        button2.style.color ="#528CE0";

    });

    button5.addEventListener('click', function(event) {
        button2.disabled = true;
        button.disabled = false;
        button.style.backgroundColor ="";
        button.style.color ="#9FA6B2";
        button2.style.backgroundColor ="#EEF2FF";
        button2.style.color ="#528CE0";

        button4.disabled = true;
        button3.disabled = false;
        button3.style.backgroundColor ="";
        button3.style.color ="#9FA6B2";
        button4.style.backgroundColor ="#EEF2FF";
        button4.style.color ="#528CE0";

    });
     button6.addEventListener('click', function(event) {
        button3.disabled = true ;
     button4.disabled = false;
     button3.style.backgroundColor ="#EEF2FF";
     button3.style.color ="#528CE0";
     button4.style.backgroundColor ="";
     button4.style.color ="#9FA6B2";

     button.disabled = true;
     button2.disabled = false;
     button2.style.backgroundColor ="";
     button2.style.color ="#9FA6B2";
     button.style.backgroundColor ="#EEF2FF";
     button.style.color ="#528CE0";

    });
    jQuery(function() {


      jQuery('#showall').click(function() {
        jQuery('.targetDiv').show();
    });
      jQuery('.showSingle').click(function() {

        jQuery('.targetDiv').hide();
        jQuery('#div' + $(this).attr('target')).show();
    });
  });
</script>

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