<x-app-layout>
    <x-slot name="header">

      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manage Account') }}
    </h2>
</x-slot>

   <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
      
      <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        
        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
          <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
          <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-3">
            <p class="text-2xl font-bold text-gray-600 mb-4">Add Account</p>
            <div class="modal-close cursor-pointer z-50">
              <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
              </svg>
            </div>
          </div>

          <!--Body-->
         
           <form method="POST" action="{{ route('admin.store.account') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select id="role" name="role" class="block mt-1 w-full form-select" required>
                    <option>Employee</option>
                    <option>Catering</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="number_phone" value="{{ __('Number Phone') }}" />
                <x-jet-input id="number_phone" class="block mt-1 w-full {{ $errors->has('number_phone') ? 'border-1 border-red-300' :'' }}" type="text" name="number_phone" :value="old('number_phone')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>
       

          <!--Footer-->
          <div class="flex justify-end pt-4">
            <x-jet-button class="px-4 bg-transparent p-3 rounded-lg hover:bg-gray-100 hover:text-indigo-400 mr-2 bg-blue-500 p-3 rounded-lg text-white">   {{ __('Save') }}</x-jet-button>
           
          </div>
           </form>
        </div>
      </div>
    </div>

<div class="py-12">

    <div class="max-w-7xl mx-auto  lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg Static h-full">
            <div class="px-4 py-2 border-b border-gray-200 flex justify-between items-center bg-white sm:py-4 sm:px-6 sm:items-baseline">
                <div class="flex-shrink min-w-0 flex items-center">
                  <h3 class="flex-shrink min-w-0 font-regular text-base md:text-lg leading-snug truncate">
                   Account Data
               </h3>
           </div>
           <div class="ml-4 flex flex-shrink-0 items-center">

              <input type="text" name="searching" class="focus:ring-red-100 focus:border-red-100 flex-1 block w-full bg-gray-100 rounded-l rounded-r-md sm:text-sm border-gray-100 py-2 px-4 mr-2 hover:border-blue-200 " placeholder="Search" id="searching" onkeyup="searchingEmployee()" >

              <div class="flex items-center text-sm sm:hidden">
                <button type="button" onclick="previousSlide()" id="btn-slide-dis" class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
               <i class="fas fa-th"></i>
             </button>
             <button type="button" onclick="nextSlide()" id="btn-slide-dis-2"  class="inline-block rounded-lg font-medium leading-none py-3 px-3 focus:outline-none text-gray-400 hover:text-gray-600 focus:text-gray-600">
                 <i class="fas fa-table"></i>
             </button>
         </div>
         
         <div class="hidden sm:flex items-center text-sm md:text-base">
            <button type="button" id="btn-slide-disx" onclick="previousSlide()"   class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600 ">
              Grid
          </button>
          <button type="button" id="btn-slide-dis-2x"  onclick="nextSlide()"  class="ml-2 inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none text-gray-500 hover:text-indigo-600 focus:text-indigo-600" >          
            Tables
        </button>
    </div>

    <div class="flex items-center">
        <div class="pl-4 pr-4 self-stretch">
          <div class="h-full border-l border-gray-200"></div>
      </div>
      <button type="button" class="ml-1 text-gray-400 hover:text-gray-500 text-blue-400 font-medium text-2xl modal-open" id="modal-click" >
          <i class="fas fa-plus-square"></i> 
      </button>
  </div>
</div>
</div>

<div class="relative md:h-screen h-full">
    <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto" >      

        <div class="grid grid-flow-row md:grid-cols-6 grid-cols-3 gap-4 w-full items-center text-center mt-10 h-max"   style="height: fit-content;">      

            <ul id="myUL" class="contents">         
                 @foreach($users->where('role','Employee') as $user)
                 <li>
                    <a href="#">
                        <div class="flex flex-col text-center mb-6">
                           <div class="flex-auto m-auto">

                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-24 w-24 object-cover">
                        </div>
                        <div class="flex-auto text-base font-semibold text-gray-600 mt-2">{{$user->name}}</div>
                        <div class="flex-auto text-base font-base text-purple-600">{{$user->role}}</div>     

                    </div>
                </a>
            </li>
                  @endforeach

                    @foreach($users->where('role','Catering') as $user)
                 <li>
                    <a href="#">
                        <div class="flex flex-col text-center mb-6">
                           <div class="flex-auto m-auto">
                           
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-24 w-24 object-cover">
                        </div>
                        <div class="flex-auto text-base font-semibold text-gray-600 mt-2">{{$user->name}}</div>
                        <div class="flex-auto text-base font-base text-orange-600">{{$user->role}}</div>     

                    </div>
                </a>
            </li>
                  @endforeach
            
    </ul>
</div>
  

</div>

<div class="absolute inset-0 w-full h-full bg-gray-900 text-white flex text-5xl transition-all ease-in-out duration-1000 transform translate-x-full slide p-6" >

   <div class="bootstrapiso w-full bg-transparent ">
    <table class="w-full table min-w-full divide-y divide-gray-200 text-white text-center rounded-lg  table-dark table-borderless" 
    id="table"        
    data-locale="en-US"
    data-show-refresh="false"
    data-show-toggle="false"        
    data-show-columns="true"        
    data-show-export="true"
    data-click-to-select="true"
    data-toggle="table"
    data-search="true"
    data-detail-formatter="detailFormatter"
    data-page-list="[10, 25, 50, 100, all]"
    data-show-pagination-switch="false"
    data-pagination="true"
    data-minimum-count-columns="2"
    data-response-handler="responseHandler"
    data-export-types= "['excel','doc', 'txt']">
    
            <thead class="bg-gray-800 text-white uppercase font-semibold text-sm ">
            <th data-sortable="true">No</th>      
            <th >Name</th>
            <th>Email</th>
            <th data-visible="true">Role</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $a=1;?>
        @foreach($users->where('role','Employee') as $user)
        <tr>
            <td>{{ $a++ }}</td>            
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role}}</td>
        </tr>
        @endforeach

        @foreach($users->where('role','Catering') as $user)
        <tr>
            <td>{{$a++}}</td>           
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


</div>
</div>



</div>
<script src="{{asset('resources/js/myJs.js')}}"></script>
<script src="{{asset('resources/js/searching.js')}}"></script>
</x-app-layout>
