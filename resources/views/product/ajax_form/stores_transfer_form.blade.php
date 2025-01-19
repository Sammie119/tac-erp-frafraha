<div class="row mb-2">
    <div class="form-group col-4">
        <select class="form-control bg-white" name="product_id[]" ><option value="${data.product_id}" selected>${data.product_description}</option></select>
    </div>
    <div class="form-group col-1">
        <select class="form-control bg-white" name="stock[]"><option selected>${data.stock}</option></select>
    </div>
    <div class="form-group col-2">
        <input type="number" min="0" step="1" placeholder="0" class="form-control bg-white" name="transfer_quantity[]" required>
    </div>
    <div class="form-group col-2">
        <input type="number" min="0" step="1" placeholder="0" class="form-control bg-white" name="approved_quantity[]" readonly>
    </div>
    <div class="form-group col-2">
        <input type="text" placeholder="Remarks" class="form-control bg-white" name="remarks[]" readonly>
    </div>
    <div class="form-group col-1">
        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
    </div>
</div>
