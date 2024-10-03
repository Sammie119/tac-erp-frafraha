<div class="row mb-2">
    <div class="form-group col-6">
        <select class="form-control bg-white" name="product_id[]"><option value="${data.product_id}" selected>${data.product_description}</option></select>
    </div>
    <div class="form-group col-2">
        <input type="number" class="form-control bg-white px-0 quantity" name="quantity[]" style="text-align: center;" required>
    </div>
    <div class="form-group col-1">
        <select class="form-control bg-white px-0 price" name="unit_price[]" style="text-align: center;"><option selected>${data.price}</option></select>
    </div>
    <div class="form-group col-2">
        <input type="number" min="0" step="0.01" class="form-control bg-white sub_total" name="amount[]" readonly>
    </div>
    <div class="form-group col-1">
        <button type="button" class="btn btn-danger btn-sm bottn_delete" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
    </div>
</div>
