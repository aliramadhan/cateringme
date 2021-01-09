<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedule') }}
        </h2>
    </x-slot>
    
    @if (session('message'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <div class="py-12">
        <form action="{{route('admin.store.schedule')}}" method="POST">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <input type="month" name="month" class="month-select">
                <input type="submit" name="submit">
                
            </div>
            <div id="showresults">
                
            </div>
        </div>
        </form>
    </div>
</x-app-layout>
<script type="text/javascript">
    $('.month-select').change(function() {
        var date = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('admin.get_month_schedule') }}",
            type: "POST",
            data: {month : date},
            success: function(data) {
                if (data == null) {
                    alert('Error get date.');
                }
                else{
                    var input = "";
                    $.each(data, function(d, v){
                        input = input + v;
                    });
                    $("#showresults").html(input);
                }
            }
        });
    });
</script>