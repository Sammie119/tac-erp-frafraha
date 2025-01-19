<form method="POST" action="sales_banking_store" enctype="multipart/form-data">
    @csrf
    @isset($sale)
        @method('put')
        <input type="hidden" name="id" value="{{ $sale->id }}">
    @endisset

    <div class="row">
        <div class="col-6 mb-2">
            <label for="name" class="col-form-label">Start Date</label>
            <input type="date" max="{{ date('Y-m-d') }}" @cannot(\App\Enums\PermissionsEnum::APPROVESALESBANKING->value) min="{{ date('Y-m-d', strtotime('-7 days')) }}" @endcannot class="form-control start_date" name="start_date" id="start_date" value="{{ isset($sale) ? $sale->start_date: '' }}" required>
        </div>

        <div class="col-6 mb-2">
            <label for="name" class="col-form-label">End Date</label>
            <input type="date" max="{{ date('Y-m-d') }}" @cannot(\App\Enums\PermissionsEnum::APPROVESALESBANKING->value) min="{{ date('Y-m-d', strtotime('-7 days')) }}" @endcannot class="form-control" name="end_date" id="end_date" value="{{ isset($sale) ? $sale->end_date: '' }}" required>
        </div>

        <div class="col-6 mb-2">
            <label for="amount_received" class="col-form-label">Amount Received</label>
            <input type="text" step="0.01" class="form-control" name="amount_received" id="amount_received" value="{{ isset($sale) ? $sale->amount_received : '' }}" placeholder="0.00" readonly>
        </div>

        <div class="col-6 mb-2">
            <label for="amount_banked" class="col-form-label">Amount Banked</label>
            <input type="number" step="0.01" class="form-control" name="amount_banked" id="amount_banked" value="{{ isset($sale) ? $sale->amount_banked : '' }}" placeholder="0.00" required>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-2">
            <label for="image" class="col-form-label">Upload Pay-in-Slip</label>
            <input type="file" id="image" name="image_url" class="form-control" @empty($sale) required @endempty>
        </div>
        <div class="input-group mb-1">
            @isset($sale->image_url)
                <img src="/storage/{{ $sale->image_url }}" alt="Image" width="150">
            @endisset
        </div>

        @isset($sale)
            <div class="col-12 mb-2">
                <label for="status" class="col-form-label">Status</label>
                <x-input-select
                    :options="['Pending','Approved', 'Rejected']"
                    :selected="isset($sale) ? $sale->status : 0"
                    :values="[0, 1, 2]"
                    :type="1"
                    name="status"
                    required
                />
            </div>

            <div class="col-12 mb-2">
                <label for="remarks" class="col-form-label">Remarks</label>
                <input type="text" class="form-control" name="remarks" value="{{ isset($sale) ? $sale->remarks: "" }}" required>
            </div>
        @endisset
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $('#end_date').change(function(){

            var start_date = $('#start_date').val();

            var end_date = $('#end_date').val();

            $.ajax({
                type:'POST',
                url:'sales_received',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    start_date, end_date
                },
                success:function(data) {
                    // alert(data);
                    if(data === 0){
                       alert(`No Sales were made from ${start_date} to ${end_date}`);
                    }

                    $('#amount_received').val(data);
                }
            });
        });
    });
</script>


