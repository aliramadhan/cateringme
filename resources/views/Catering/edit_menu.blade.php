<x-app-layout>

    <div class="notify z-50 font-semibold absolute left-0"><span id="notifyType" class=""></span></div>
      <div id="success" class="invisible absolute"></div>
      <div id="failure" class="invisible absolute"></div>


      @if (session('message'))
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

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Editing {{$menu->name}}
        </h2>
    </x-slot>
      <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

          <div  class="md:grid md:grid-cols-3 md:gap-6 mb-8">
           <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium text-gray-900">Catering Information</h3>

              <p class="mt-1 text-sm text-gray-600">
                Update your catering information like name and description.
              </p>
            </div>
          </div>


          <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('catering.update.menu',$menu->menu_code)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">

                      <div class="col-span-6 sm:col-span-4">
                       <label class="block font-medium text-sm text-gray-700" for="name">
                        Name
                      </label>

                      <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" autocomplete="name" name="name" value="{{$menu->name}}"> 


                    </div>

                  <!-- Description -->
                  <div class="col-span-6 sm:col-span-4">
                   <label class="block font-medium text-sm text-gray-700" for="desc"> 
                    Description
                  </label>
                  <textarea name="desc" class="form-input rounded-md shadow-sm mt-1 block w-full">{{$menu->desc}}</textarea>



                </div>
              </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">


              <button type="submit" class="opacity-75 hover:opacity-100 items-center px-4 py-2  border-transparent rounded-md font-semibold text-lg uppercase tracking-widest  active:bg-gray-900 active:text-white focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" name="submit" value="UpdateInfo">
                Save
              </button>
            </div>
          </div>
       
      </div>
    </div>

    <div  class="md:grid md:grid-cols-3 md:gap-6">
           <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium text-gray-900">Catering Pictures</h3>

              <p class="mt-1 text-sm text-gray-600">
                Update your catering pictures.
              </p>
            </div>
          </div>


          <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                 

                <div  class="col-span-6 sm:col-span-4">
              
                 @foreach($menu->photos as $photo)
                <label class="block font-medium text-sm text-gray-700" for="photo">
                  Picture {{$loop->iteration}}
                </label>
                 <div class="mt-2" x-show="! photoPreview">
                  <img src="{{url('public/'.$photo->file)}}" alt="Catering 1" class="rounded-full h-40 w-40 object-cover">
                </div>
                <input type="file" name="{{$photo->id}}" accept="image/x-png,image/gif,image/jpeg" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 mr-2 mb-8">    
                <a href="{{route('catering.delete.photo',$photo->id)}}"" class="bg-red-400 text-white hover:bg-red-500 transition-500 py-2 px-4 rounded-lg" onclick="return confirm('Delete Picture {{$loop->iteration}} photo?');">Delete 
                </a>

                 @endforeach
               
                 <div class="input-group hdtuto control-group lst increment" >
                  <div class="input-group-btn"> 
                    <p class="mt-1 text-sm text-gray-600">
                      Add new photos (choose multiple pictures).
                    </p>
                  </div>
                </div>
                <div class="clone hide">
                  <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                    <input type="file" name="addPhoto[]" class="myfrm inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 mr-2 mb-8" multiple>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="opacity-75 hover:opacity-100 items-center px-4 py-2  border-transparent rounded-md font-semibold text-lg uppercase tracking-widest  active:bg-gray-900 active:text-white focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" name="submit" value="UpdatePhoto">
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--
  <div  class="md:grid md:grid-cols-3 md:gap-6">
           <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium text-gray-900">Delete Catering</h3>

              <p class="mt-1 text-sm text-gray-600">
                Delete your catering forever.
              </p>
            </div>
          </div>


          <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('catering.delete.menu',$menu->menu_code)}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="bg-red-400 opacity-75 hover:opacity-100 items-center px-4 py-2  border-transparent rounded-md font-semibold text-lg uppercase tracking-widest  active:bg-gray-900 active:text-white focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" name="submit" onclick="return confirm('Delete {{$menu->name}} forever?')">
                Delete Menu
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  -->
</div>
</x-app-layout>