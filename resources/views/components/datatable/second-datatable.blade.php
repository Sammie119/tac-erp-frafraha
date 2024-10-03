<style>
    #dt-search-1 { width: 500px }
</style>

<table id="second_results_table" class="table table-striped">
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
                    menu: [ 10, 25, 50, 100 ]
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
