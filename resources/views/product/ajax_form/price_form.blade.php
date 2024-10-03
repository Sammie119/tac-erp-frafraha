<div class="row mb-2">
    <div class="form-group col-7">
        <select class="form-control bg-white" name="product_id[]" ><option value="${data.product_id}" selected>${data.product_description}</option></select>
    </div>
    <div class="form-group col-2">
        <input type="number" min="0" step="0.01" placeholder="${data.cost}" class="form-control bg-white" name="new_cost[]" required>
    </div>
    <div class="form-group col-2">
        <input type="number" min="0" step="0.01" placeholder="${data.price}" class="form-control bg-white" name="new_price[]" required>
    </div>
    <div class="form-group col-1">
        <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)" style="padding-top: 8px; padding-bottom: 8px;"><i class="bi bi-trash"></i></button>
    </div>
</div>
