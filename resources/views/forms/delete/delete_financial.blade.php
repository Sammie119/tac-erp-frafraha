<form method="POST" action="delete_financial">
    @csrf

    <input type="hidden" name="id" value="{{ $financial }}">

    <label>Deleting this record is an irreversible action. Do you want to continue...?</label>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
    </div>
</form>
