

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
  display: inline-block;
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
            Create Catering Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
                <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
    <div class="flex-shrink min-w-0 flex items-center">
      <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
        <a href="#component-db11f83176d113e39bf2559da9344b1c">Two-column cards with separate submit actions</a>
      </h3>
           </div>
    <div class="ml-4 flex flex-shrink-0 items-center">
      <div class="flex items-center text-sm sm:hidden">
        <button type="button" @click="activeTab === 'preview' ? (activeTab = 'code') : (activeTab = 'preview')" :class="{'bg-indigo-50 text-indigo-700': activeTab === 'code', 'text-gray-400 hover:text-gray-600 focus:text-gray-600': activeTab !== 'code'}" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <div class="hidden sm:flex items-center text-sm md:text-base">
        <button type="button" @click="activeTab = 'preview'" :class="{'bg-indigo-50 text-indigo-700': activeTab === 'preview', 'text-gray-500 hover:text-indigo-600 focus:text-indigo-600': activeTab !== 'preview'}" class="inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none bg-indigo-50 text-indigo-700">
          Preview
        </button>
        <button type="button" @click="activeTab = 'code'" :class="{'bg-indigo-50 text-indigo-700': activeTab === 'code', 'text-gray-500 hover:text-indigo-600 focus:text-indigo-600': activeTab !== 'code'}" class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600">
          Code
        </button>
              
              </div>
      <div class="hidden sm:flex sm:items-center">
        <div class="pl-4 pr-4 self-stretch">
          <div class="h-full border-l border-gray-200"></div>
        </div>
                <button type="button" @click="$refs[`${activeSnippet}ClipboardCode`].select(); document.execCommand('copy')" class="ml-3 text-gray-400 hover:text-gray-500">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <title>Copy</title>
            <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"></path>
            <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
               <div class="relative h-screen ">
                <div class="absolute inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide">


                    <div class="grid grid-rows-7 gap-1 w-full">
                        <div class=" text-2xl row-span-1">
                         Choose Month
                     </div>
                     <div class="flex-row gap-2 row-span-3">
                            <?php $m=1; ?>
                         @foreach($months as $month)

                        <!--  <a href="{{route('employee.create.order',$month->format('Y-m-d'))}}" class="flex-auto bg-orange-400 rounded-lg p-4 text-white font-base text-base hover:bg-orange-600 duration-1000" onchange="showUser(this.value)">{{$month->format('F')}}</a> -->

                         <button class="flex-auto bg-orange-400 rounded-lg p-4 text-white font-base text-base hover:bg-orange-600 duration-1000 showSingle"  target="{{$m}}">{{$month->format('F')}}</button>
                             <?php $m++; ?>
                         @endforeach                             

                            

                     </div>

                     <div class=" text-2xl row-span-1">
                         Choose Day
                     </div>
                     <div class="flex-row gap-2 row-span-3">
                        <div id="txtHint"></div>

                        <div id="div1" class="hidden duration-1000 targetDiv"> 
                        <h1>January</h1>
                        <?php
                         for ($i=1; $i < 31; $i++) { 
                        ?>
                            <label class="label flex-auto  duration-1000">
                                <input class="label__checkbox  duration-1000" type="checkbox" value="<?php echo $i; ?>" name="cek<?php echo $i; ?>">
                                <span class="label__text font-base">
                                  <span class="label__check p-4  bg-orange-400 rounded-lg text-white  hover:bg-orange-600 duration-1000">
                                    <i class="fa icon text-base font-bold absolute "><?php echo $i; ?></i>
                                </span>
                            </span>
                        </label>
                        <?php } 
                        ?>
                        </div>

                        <div id="div12"  class="hidden duration-1000 targetDiv"> 
                        <h1>December</h1>
                        <?php
                         for ($i=1; $i < 26 ; $i++) { 
                        ?>
                            <label class="label flex-auto  duration-1000">
                                <input class="label__checkbox  duration-1000" type="checkbox" value="<?php echo $i; ?>" name="cek<?php echo $i; ?>">
                                <span class="label__text font-base">
                                  <span class="label__check p-4  bg-orange-400 rounded-lg text-white  hover:bg-orange-600 duration-1000">
                                    <i class="fa icon text-base font-bold absolute "><?php echo $i; ?></i>
                                </span>
                            </span>
                        </label>
                        <?php } 
                        ?>
                        </div>

                        <div id="div5"  class="hidden targetDiv"> 
                        <h1>May</h1>
                        <?php
                         for ($i=1; $i < 29 ; $i++) { 
                        ?>
                            <label class="label flex-auto  duration-1000">
                                <input class="label__checkbox  duration-1000" type="checkbox" value="<?php echo $i; ?>" name="cek<?php echo $i; ?>">
                                <span class="label__text font-base">
                                  <span class="label__check p-4  bg-orange-400 rounded-lg text-white  hover:bg-orange-600 duration-1000">
                                    <i class="fa icon text-base font-bold absolute "><?php echo $i; ?></i>
                                </span>
                            </span>
                        </label>
                        <?php } 
                        ?>
                        </div>

                    </div>
                </div>

            </div>
            <div class="absolute inset-0 w-full h-full bg-purple-500 text-white flex items-center justify-center text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide">There</div>
            <div class="absolute inset-0 w-full h-full bg-teal-500 text-white flex items-center justify-center text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide">Booya!</div>

            <div onclick="nextSlide()" class="absolute bottom-10 right-10 bg-white w-16 h-16 flex items-center justify-center text-black cursor-pointer bg-blue-200">&#x276F;</div>
            <div onclick="previousSlide()" class="absolute bottom-10 right-10 bg-white w-16 h-16 mr-16 border-r border-gray-400 flex items-center justify-center text-black cursor-pointer bg-blue-200">&#x276E;</div>
        </div>


    </div>
</div>
</div>


<script type="text/javascript">
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
@foreach($months as $month)
    function myFunction{{$month->format('F')}}() {
      var x = document.getElementById("myDIV{{$month->format('F')}}");
      if (x.style.display == "block") {
       
        x.style.display = "none";

       
      } else {
          x.style.display = "block";



              
      }
    }
  @endforeach    
    function showUser(str) {
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","get_bulan.php?q="+str,true);
            xmlhttp.send();
        }
    }




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