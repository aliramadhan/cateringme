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
           Editing SlideShow
        </h2>
    </x-slot>
      <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <div  class="md:grid md:grid-cols-3 md:gap-6">
           <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium text-gray-900">Slideshow Pictures</h3>

              <p class="mt-1 text-sm text-gray-600">
               Upload your picture for slideshow app, you can add more than 2 pictures with clicked button add frame.
              </p>
            </div>
          </div>


          <div class="mt-5 md:mt-0 md:col-span-2">
              <form id="formUp" action="{{route('admin.store.slideshow')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="shadow overflow-hidden sm:rounded-md">
               <div class="bg-white ">

                 @foreach($slides as $slide)
                <div class="md:grid md:grid-cols-4 px-6 py-8 border-b flex-wrap-reverse flex">
                <label class="md:block hidden font-semibold text-lg text-gray-700 col-span-4" for="slide">
                  Picture {{$loop->iteration}}
                </label>
              
                  <div class="md:col-span-3 col-span-4">
                    <div class="mt-2">
                      <x-jet-label for="name" value="{{ __('Name') }}" class="mb-1" />
                      <x-jet-input type="text" name="name{{$slide->id}}" placeholder="picture name" value="{{$slide->name}}" class="w-full md:w-auto" />
                      <x-jet-input-error for="name" class="mt-2" />
                    </div>                

                      <div class="mt-2 ">
                        <x-jet-label for="name" value="{{ __('Upload Picture') }}" class="mb-1" />
                        <input type="file" name="file{{$slide->id}}" accept="image/x-png,image/gif,image/jpeg" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300  font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mr-2 mb-8 md:w-11/12 w-full lg:w-auto rounded-lg">    
                        <a href="{{route('admin.delete.slideshow',$slide->id)}}" class="bg-red-400 text-white hover:bg-red-500 transition-500 py-2 px-4 rounded-lg" onclick="return confirm('Delete slide {{$slide->name}}?');">Delete 
                        </a>
                      </div>   
                    </div>
                    
                    <div class="md:col-span-1 col-span-4">
                     <div class="mt-2" x-show="! photoPreview">
                      <img src="{{url('public/'.$slide->file)}}" alt="Catering 1" class="rounded-xl h-40 w-40 object-cover">
                    </div>
                  </div>
                   <label class="block  md:hidden font-semibold text-lg text-gray-700 w-full" for="slide">
                  Picture {{$loop->iteration}}
                </label>


                  </div>

                 @endforeach
              
            </div>
          </div>
          <h2 class="font-semibold text-2xl mt-10 text-gray-800 leading-tight px-3">
            New Picture Form
             <p class="mt-1 text-sm text-gray-600">
               You can upload multiple picture.
              </p>
         </h2>
          <div class="bg-white shadow-md mt-6">
          
              <div class="input-group hdtuto control-group lst increment grid grid-cols-4 px-6 py-8 border-b" >
                <div class="col-span-4">
                  <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" class="mb-1" />
                    <x-jet-input type="text" name="name[]" placeholder="picture name"  />
                    <x-jet-input-error for="name" class="mt-2" />
                  </div>

                      <div class="mt-2">
                        <x-jet-label for="name" value="{{ __('Upload Picture') }}" class="mb-1" />
                        <input type="file" name="inputFile[]"  accept="image/x-png,image/gif,image/jpeg" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300  font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mr-2 mb-8 myfrm md:w-auto w-full rounded-lg" multiple>  
                      </div> 
                    </div>
              </div>             
            
            <div class="clone hide" style="display: none;">
              <div class="deletethis hdtuto control-group lst input-group grid grid-cols-4 px-6 py-8 border-b" >
                <div class="lg:col-span-3 col-span-4">
                <div>
                      <x-jet-label for="name" value="{{ __('Name') }}" class="mb-1" />
                      <x-jet-input type="text" name="name[]" placeholder="picture name"  />
                      <x-jet-input-error for="name" class="mt-2" />
                </div>
                <div class="mt-2">
                  <x-jet-label for="name" value="{{ __('Upload Picture') }}" class="mb-1" />
                  <input type="file" name="inputFile[]"  accept="image/x-png,image/gif,image/jpeg" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300  font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mr-2 mb-8 myfrm md:w-auto w-full rounded-lg" multiple>    
                </div>
                </div>

                <div class="input-group-btn"> 
                 <button class="bg-red-500 text-white py-2 px-8 rounded-lg btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 justify-between">
              <button class="addnew bg-blue-400 text-white rounded-lg py-2 px-4" type="button"><i class="fas fa-plus p-1 border rounded-full text-base hover:border-blue-400  focus:outline-none mr-2"></i>Frame</button>
                  <button type="submit" name="submit" value="AddPhoto" class="opacity-75 hover:opacity-100 items-center px-4 py-2  border-transparent rounded-md font-semibold text-lg uppercase tracking-widest  active:bg-gray-900 active:text-white focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" >
                    Save
                  </button>
                </div>
              </form>   
            </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $(".addnew").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("#formUp").on("click",".btn-danger",function(){
          $(this).parents(".deletethis").remove();
      });
    });
</script>
</x-app-layout>
