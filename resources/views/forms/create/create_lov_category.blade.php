<form method="POST" action="system_lovs_store">
    @csrf
    @isset($dropdown)
        @method('put')
        <input type="hidden" name="id" value="{{ $dropdown->id }}">
    @endisset

    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">{{ __('Category') }}</label>
        <div class="col-sm-10">
            <input type="text" name="name" id="name" class="form-control" value="@isset($dropdown) {{ $dropdown->category_name }} @endisset" required autofocus autocomplete="name">
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

