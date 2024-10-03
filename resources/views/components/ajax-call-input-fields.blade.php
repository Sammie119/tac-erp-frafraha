@props(['ajax_url', 'form'])

<input type="hidden" value="{{ $ajax_url }}" id="ajax-url">

@push('scripts')
    <script>
        // const inputDisplay = document.getElementById('inputDisplay')
        $("body").on("click",".addProduct", function (){
            var search = $('.product').val();

            const url = $('#ajax-url').val();

            if(search === ''){
                alert('Input Empty!!!');
            }else {
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
                        if(data.product_name === 'No_data'){
                            alert('Item does not Exist!!!');
                        }else{
                            document.querySelector('#contentProduct').insertAdjacentHTML(
                                'beforeend',
                                `@include($form)`
                            );
                        }

                        document.querySelector('.show_data').style.display='none';

                        $('.product').val('');
                        $('.product').focus();

                    }
                });
            }

        });

    </script>
@endpush

<script>

    function removeRow (input) {
        input.parentNode.parentElement.remove()
    }

</script>
