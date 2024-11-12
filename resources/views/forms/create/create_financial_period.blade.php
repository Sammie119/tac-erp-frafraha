<form method="POST" action="financial_period_store">
    @csrf
    @isset($period)
        @method('put')
        <input type="hidden" name="id" value="{{ $period->period_id }}">
    @endisset

    <div class="mb-2">
        <label for="name" class="col-form-label">Name of Financial Year</label>
        <input type="text" class="form-control" name="name" value="@isset($period) {{ $period->name }} @endisset" required>
    </div>

    <div class="mb-2">
        <label for="description" class="col-form-label">Description</label>
        <input type="text" class="form-control" name="description" value="@isset($period) {{ $period->description }} @endisset" required>
    </div>

    <div class="mb-2">
        <label for="start_date" class="col-form-label">Start Date</label>
        <input type="date" max="{{ date('Y-m-d') }}" class="form-control" name="start_date" value="@isset($period) {{ $period->start_date }} @endisset" required>
    </div>

    <div class="mb-2">
        <label for="end_date" class="col-form-label">End Date</label>
        <input type="date" min="{{ date('Y-m-d') }}" class="form-control" name="end_date" value="@isset($period) {{ $period->end_date }} @endisset">
    </div>

    <div class="mb-2">
        <label for="status" class="col-form-label">Status</label>
        <x-input-select
            :options="['Active', 'Inactive']"
            :selected="isset($period) ? $period->status : 2"
            :values="[1, 0]"
            :type="1"
            name="status"
            required
        />
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

