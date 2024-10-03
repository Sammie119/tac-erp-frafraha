<form method="POST" action="attendance_store" enctype= multipart/form-data>
    @csrf

    <div class="row mb-3">
        <div class="col-sm-12">
            <input type="file" name="file" id="file" class="form-control" required autofocus autocomplete="file">
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

