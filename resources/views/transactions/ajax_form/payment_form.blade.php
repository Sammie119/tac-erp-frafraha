<div class="row mb-2">
    <div class="form-group col-2">
        <select class="form-control bg-white" name="transaction_id[]" ><option value="${data.transaction_id}" selected>${data.invoice_no}</option></select>
    </div>
    <div class="form-group col-5">
        <select class="form-control bg-white"><option selected>${data.customer_name}</option></select>
    </div>
    <div class="form-group col-2">
        <input type="number" min="0" step="1" placeholder="0" class="form-control bg-white" value="${data.transaction_amount}" readonly>
    </div>
    <div class="form-group col-2">
        <input type="number" min="1" step="0.01" placeholder="0" class="form-control bg-white paid_amount" name="paid_amount[]" required>
        <input type="hidden" class="sub_total">
    </div>
    <div class="form-group col-1">
        <button type="button" class="btn btn-danger btn-sm bottn_delete" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
    </div>
</div>
