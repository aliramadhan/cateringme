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
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                 

                <div  class="col-span-6 sm:col-span-4">
                <form action="{{route('admin.store.slideshow')}}" method="POST">
                @csrf
                 @foreach($slides as $slide)
                <label class="block font-medium text-sm text-gray-700" for="slide">
                  Picture {{$loop->iteration}}
                </label>
                 <div class="mt-2" x-show="! photoPreview">
                  <img src="{{url('public/'.$slide->file)}}" alt="Catering 1" class="rounded-full h-40 w-40 object-cover">
                </div>
                <input type="text" name="name{{$slide->id}}" placeholder="name here" value="{{$slide->name}}">
                <input type="file" name="file{{$slide->id}}" accept="image/x-png,image/gif,image/jpeg" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 mr-2 mb-8">    
                <a href="{{route('admin.delete.slideshow',$slide->id)}}"" class="bg-red-400 text-white hover:bg-red-500 transition-500 py-2 px-4 rounded-lg" onclick="return confirm('Delete slide {{$slide->name}}?');">Delete 
                </a>

                 @endforeach
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button type="submit" class="opacity-75 hover:opacity-100 items-center px-4 py-2  border-transparent rounded-md font-semibold text-lg uppercase tracking-widest  active:bg-gray-900 active:text-white focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" name="submit" value="UpdatePhoto">
                    Update
                  </button>
                </div>
                </form>
               
                 <div class="" >
                  <div class="input-group-btn"> 
                   
                  </div>
                </div>
                <form id="formUp" method="POST" action="{{route('admin.store.slideshow')}}" enctype="multipart/form-data">
                @csrf


                <div class="input-group hdtuto control-group lst increment" >
                  <input type="text" name="name[]" placeholder="name here">
                  <input type="file" name="file[]" class="myfrm form-control">
                  <div class="input-group-btn"> 
                    <button class="addnew bg-blue-400 text-white rounded-lg py-2 px-4" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add Frame</button>
                  </div>
                </div>
                <div class="clone hide">
                  <div class="deletethis hdtuto control-group lst input-group" style="margin-top:10px">
                    <input type="text" name="name[]" placeholder="name here">
                    <input type="file" name="file[]" class="myfrm form-control">
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>


                <button type="submit" name="submit" value="AddPhoto" class="btn btn-success" style="margin-top:10px">Submit</button>


            </form>   
              </div>
              </div>
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
          console.log(lsthmtl);
          $(".increment").after(lsthmtl);
      });
      $("#formUp").on("click",".btn-danger",function(){
          $(this).parents(".deletethis").remove();
      });
    });
</script>
</x-app-layout>