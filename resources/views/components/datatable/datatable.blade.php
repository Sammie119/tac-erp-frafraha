<link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
<style>
    #dt-search-0 { width: 500px }
</style>

<table @if($checkData == 1) id="results_table" @endif class="table table-striped">
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

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>--}}
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>

<script>
    // new DataTable('#example');
    new DataTable('#results_table', {
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

    var table = $('#results_table').DataTable();

    // #myInput is a <input type="text"> element
    $('#mySearchField').on('keyup change', function () {
        table.search(this.value).draw();
    });

    $('#mySearchField').on('search', function() {
        table.search(this.value).draw();
    });
</script>
