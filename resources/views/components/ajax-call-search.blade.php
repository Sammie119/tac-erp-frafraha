@props(['url'])

<input type="hidden" value="{{ $url }}" id="url">

@push('scripts')
    <script>
        window.onload = function(){
            // Table filter
            $('#search').on('search', function() {
                search_table($(this).val());
            });

            $('#search').keyup(function(){
                search_table($(this).val());
            });

            $('#search-addon').bind('click',function(){

                var search = $('#search').val();

                const url = $('#url').val();

                $.ajax({
                    type:'POST',
                    url:`${url}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        search
                    },
                    success:function(data) {
                        if(data === ''){
                            $("#search_results_table").empty();
                            $("#search_results_table").html("<tr><td colspan='40'>No data Found</td></tr>");
                        }
                        else {
                            $("#search_results_table").empty();
                            $("#search_results_table").html(data);
                        }
                    }
                });
            });

            {{--Table filter--}}
            function search_table(value){
                $('#search_results_table tr').each(function(){
                    var found = 'false';

                    $(this).each(function(){
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){
                            found = 'true';
                        }
                    });

                    if(found == 'true'){
                        $(this).show();
                    }
                    else{
                        $(this).hide();
                    }
                });
            }

        };

    </script>
@endpush
