<style>
    #dt-search-1 { width: 500px }
</style>

<table @if($checkData == 1) id="second_results_table" @endif class="table table-striped">
    <thead>
    <tr>
        @foreach($headers as $header)
            <th {{ $header['nowrap'] }} class="{{ $header['classes'] }}" style="width: {{ $header['width'] }}">{{ $header['name'] }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody id="search_results_table">

    {{ $slot }}

    </tbody>
</table>

<script>
    // new DataTable('#example');
    new DataTable('#second_results_table', {
        layout: {
            topStart: null,
            top: null,
            //     {
            //     search: {
            //         placeholder: 'Type search here',
            //     }
            // },
            topEnd: null,
            bottomEnd: {
                pageLength: {
                    menu: [ 5, 10, 25, 50, 100, 500, 1000 ]
                },
                paging: {
                    buttons: 10
                }
            }
        },
        "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false,
        } ]
    });

    var table1 = $('#second_results_table').DataTable();

    // #myInput is a <input type="text"> element
    $('#mySearchField2').on('keyup change', function () {
        table1.search(this.value).draw();
    });

    $('#mySearchField2').on('search', function() {
        table1.search(this.value).draw();
    });
</script>
