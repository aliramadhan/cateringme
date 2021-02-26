<x-app-layout>
  <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
  <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Manage Account') }}
    </h2>
  </x-slot>

  <div id="success" class="invisible absolute"></div>
   <div id="failure" class="invisible absolute"></div>
  
      @if(session('message'))
        <script type="text/javascript">
          function notifu(){
          document.getElementById('success').click();
          var scriptTag = document.createElement("script");        
          document.getElementsByTagName("head")[0].appendChild(scriptTag);
        }          
      </script>
      <style type="text/css">  .success:before{
        Content:" {{ session('message') }}";
      }</style>
       
            
        @endif
        @if($errors->any())
        <script type="text/javascript">
         function notifu(){
          document.getElementById('failure').click();
          var scriptTag = document.createElement("script");        
          document.getElementsByTagName("head")[0].appendChild(scriptTag);
        }          
      </script>
        <style type="text/css">  .failure:before{
          Content:"{{ implode('', $errors->all(':message')) }}";
        }</style>
       
        @endif

  <!--Modal-->
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50" id="addModal">
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

          <div class="mt-4  grid grid-cols-2 gap-2">
              <div>
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <div>
                            <x-jet-label for="role" value="{{ __('Status') }}" />
            <select id="role" name="role" class="block mt-1 w-full form-select" required>
              <option>Employee</option>
              <option>Catering</option>
            </select>
            </div>
          </div>       

          <div class="mt-4 grid grid-cols-2 gap-2">
            <div>
            <x-jet-label for="division" value="{{ __('Division') }}" />
            <x-jet-input id="division" class="block mt-1 w-full" type="text" name="division" :value="old('division')" required autofocus autocomplete="division" />
            </div>
             <div>
            <x-jet-label for="roles" value="{{ __('Role') }}" />
            <x-jet-input id="roles" class="block mt-1 w-full" type="text" name="roles" :value="old('roles')" required autofocus autocomplete="roles" />
            </div>
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

    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50" id="editModal">
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
          <p class="text-2xl font-bold text-gray-600 mb-4">Edit Account</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        
        <form method="POST" action="{{ route('admin.update.account') }}">
          @csrf
          @method('PUT')
          <div>
            <x-jet-label for="editName" value="{{ __('Name') }}" />
            <x-jet-input id="editName" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          </div>

          <div class="mt-4  grid grid-cols-2 gap-2">
              <div>
            <x-jet-label for="editEmail" value="{{ __('Email') }}" />
            <x-jet-input readonly id="editEmail" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <div>
                            <x-jet-label for="role" value="{{ __('Status') }}" />
            <select disabled id="role" name="role" class="block mt-1 w-full form-select" required>
              <option>Employee</option>
              <option>Catering</option>
            </select>
            </div>
          </div>       

          <div class="mt-4 grid grid-cols-2 gap-2">
            <div>
            <x-jet-label for="editDivision" value="{{ __('Division') }}" />
            <x-jet-input id="editDivision" class="block mt-1 w-full" type="text" name="division" :value="old('division')" required autofocus autocomplete="division" />
            </div>
             <div>
            <x-jet-label for="editRoles" value="{{ __('Role') }}" />
            <x-jet-input id="editRoles" class="block mt-1 w-full" type="text" name="roles" :value="old('roles')" required autofocus autocomplete="roles" />
            </div>
          </div>

         

          <div class="mt-4">
            <x-jet-label for="editNumber_phone" value="{{ __('Number Phone') }}" />
            <x-jet-input id="editNumber_phone" class="block mt-1 w-full {{ $errors->has('number_phone') ? 'border-1 border-red-300' :'' }}" type="text" name="number_phone" :value="old('number_phone')" required />
            </div>

            <div class="mt-4">
              <x-jet-label for="editAddress" value="{{ __('Address') }}" />
              <x-jet-input id="editAddress" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-4">
              <x-jet-button class="px-4 bg-transparent p-3 rounded-lg hover:bg-gray-100 hover:text-indigo-400 mr-2 bg-blue-500 p-3 rounded-lg text-white">   {{ __('Update') }}</x-jet-button>
              
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

            <input type="text" id="searching2" onkeyup="searchingTwo()" class="focus:ring-red-100 focus:border-red-100 flex-1 block bg-gray-100 rounded-l rounded-r-md sm:text-sm border-gray-100 py-2 px-4 mr-2 hover:border-blue-200 w-28" placeholder="Search"  >
            

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
            <button type="button" class="ml-1 text-gray-400 hover:text-gray-500 text-blue-400 font-medium text-2xl  focus:outline-none" id="modal-click" >
              <i class="fas fa-plus-square modal-open" data-target="addModal" data-toggle="modal"></i> 
            </button>
          </div>
        </div>
      </div>

      <div class="relative md:h-screen h-full">
        <div class=" inset-0 w-full h-full  text-gray-600 flex text-5xl p-6 transition-all ease-in-out duration-1000 transform translate-x-0 slide text-base overflow-y-auto bg-gray-100" >      



          <div class="grid grid-flow-row md:grid-cols-3 grid-cols-1 lg:grid-cols-4 gap-8  items-center text-center mt-6 h-max mx-auto"   style="height: fit-content;">      

            <ul id="myUL" class="contents">         
             @foreach($users as $user)
             <li>                
              <a href="@if($user->role == 'Employee') {{route('admin.can_order',$user->code_number)}} @else # @endif" @if($user->can_order == 1 && $user->role == 'Employee') onclick="return confirm('Disable feature can order for {!! $user->name !!} ?')" @elseif($user->can_order == 0 && $user->role == 'Employee') onclick="return confirm('enable feature can order for {!! $user->name !!} ?')" @endif>                
               
              <div class="transform bg-white shadow-xl rounded-xl pb-3 hover:-translate-y-2 hover:shadow-2xl duration-500">
               @if($user->role == 'Employee')         
                
                 <div class="flex flex-row text-base absolute bg-gray-600 absolute rounded-tl-xl rounded-br-xl text-white px-4 hover:bg-gray-700 duration-500 cursor-pointer">
                  <div class="px-2 py-1 font-semibold ">Can Order?</div>
                  <div class="px-2 py-1 font-bold"> 
                    @if($user->can_order == 1) 
                       <font class="text-green-400">Yes</font> 
                    @else 
                      <font class="text-red-400">No</font> 
                    @endif</div>
                </div>
            
              @endif
                <div class="photo-wrapper p-2">

                    <img class="w-32 h-32 rounded-full mx-auto object-cover mt-8" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                </div>
                <div class="p-2">
                   
                    <h3 class="text-center text-xl text-gray-900 font-medium leading-8">{{$user->name}}</h3>
                    <div class="text-center text-gray-400 text-sm font-semibold">
                        <p>{{$user->role}}</p>
                    </div>
                    <div class="flex flex-col text-sm hide-scroll">
                        
                          <div class="flex flex-row mt-2">
                            <div class="px-2 py-1 text-gray-500 font-semibold w-20 text-left">Address</div>
                            <div class="px-2 py-1  text-left flex-auto">{{$user->address}}</div>
                        </div>
                        <div class="flex flex-row ">
                            <div class="px-2 py-1 text-gray-500 font-semibold w-20 text-left">Phone</div>
                            <div class="px-2 py-1  text-left flex-auto">{{$user->number_phone}}</div>
                        </div>
                        <div class="flex flex-row " >
                            <div class="px-2 py-1 text-gray-500 font-semibold w-20 text-left">Email</div>
                            <div class="px-2 py-1  text-left flex-auto">{{$user->email}}</div>
                        </div>
                      </a>
                       <button class="modal-open rounded-xl text-lg p-3 bg-blue-400 text-white font-semibold mt-4 mx-4 z-10 pointer hover:bg-blue-600" data-target="editModal" data-toggle="modal" id="modal-edit" data-name="{{$user->name}}" data-role="{{$user->role}}" data-email="{{$user->email}}" data-division="{{$user->division}}" data-roles="{{$user->roles}}" data-number_phone="{{$user->number_phone}}" data-address="{{$user->address}}">Edit Account</button>
                    </div>

                   
                </div>
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
      <th data-visible="true">Order</th>
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
      <td>
        <a class="contents" href="@if($user->role == 'Employee') {{route('admin.can_order',$user->code_number)}} @else # @endif" @if($user->can_order == 1) onclick="return confirm('Disable feature can order for {!! $user->name !!} ?')" @else onclick="return confirm('enable feature can order for {!! $user->name !!} ?')" @endif>
            @if($user->can_order == 1)  
        <button class="bg-green-200 text-green-600 py-2 font-semibold px-4 hover:bg-green-300 hover:text-green-700 transition-500" style="border-radius: 20px;">Active</button>
        @else
        <button class="bg-red-200 text-red-600 py-2 font-semibold px-4 hover:bg-red-300 hover:text-red-700 transition-500" style="border-radius: 20px;">
        non-Active</button></a>
        @endif
      </td>
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
<script type="text/javascript">
  $( "#modal-edit" ).click(function() {
    var link = $(this),
    name = link.data("name"),
    email = link.data("email"),
    role = link.data("role"),
    division = link.data("division"),
    roles = link.data("roles"),
    number_phone = link.data("number_phone"),
    address = link.data("address");

    $("#editName").val(name);
    $("#editEmail").val(email);
    $("#editRole").val(role);
    $("#editDivision").val(division);
    $("#editRoles").val(roles);
    $("#editNumber_phone").val(number_phone);
    $("#editAddress").val(address);
  });
</script>
</x-app-layout>
