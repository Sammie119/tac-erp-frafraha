<form method="POST" action="financial_store">
    @csrf
    @isset($financial)
        @method('put')
        <input type="hidden" name="id" value="{{ $financial->financial_id }}">
    @endisset

    <div class="row">
        <div class="col-6 mb-3">
            <label for="transaction_type" class="form-label">{{ __('Transaction Type') }}</label>
            <x-input-select :options="$transaction_type" :selected="isset($financial) ? $financial->type : 0" name="transaction_type" required />
        </div>
        <div class="col-6 mb-3">
            <label for="transaction_source" class="form-label">{{ __('Transaction Source') }}</label>
            <x-input-select :options="$transaction_source" :selected="isset($financial) ? $financial->source : 0" name="transaction_source" required />
        </div>

        <div class="col-12 mb-3">
            <label for="transaction_name" class="form-label">{{ __('Transaction Name') }}</label>
            <input type="text" name="transaction_name" class="form-control" value="{{ isset($financial) ? $financial->name : "" }}" id="transaction_name" placeholder="{{ __('Transaction Name') }}" required>
        </div>
        <div class="col-12 mb-3">
            <label for="description" class="form-label">{{ __('Transaction Description') }}</label>
            @isset($financial)
                <textarea name="description" id="description" rows="2" class="form-control" required>{{ $financial->description }}</textarea>
            @else
                <textarea name="description" id="description" rows="2" class="form-control" required></textarea>
            @endisset
        </div>

        <div class="col-6 mb-3">
            <label for="transaction_name" class="form-label">{{ __('Transaction Mode') }}</label>
            <x-input-select :options="$transaction_mode" :selected="isset($financial) ? $financial->mode : 0" name="transaction_mode" required />
        </div>
        <div class="col-6 mb-3">
            <label for="division" class="form-label">{{ __('Unit/Department') }}</label>
            <x-input-select :options="$department" :selected="isset($financial) ? $financial->division : 0" name="division" required />
        </div>

        <div class="col-12 mb-3">
            <label for="amount_paid_by" class="form-label">{{ __('Amount Paid By') }}</label>
            <input type="text" name="amount_paid_by" class="form-control" value="@isset($financial) {{ $financial->amount_paid_by }} @endisset" id="amount_paid_by" placeholder="{{ __('Name of Payee') }}" required>
        </div>

        <div class="col-6 mb-3">
            <label for="amount" class="form-label">{{ __('Amount') }}</label>
            <input type="number" step="0.01" min="0.1" name="amount" class="form-control" value="{{ isset($financial) ? $financial->amount : "" }}" id="amount" placeholder="{{ __('Amount') }}">
        </div>
        <div class="col-6 mb-3">
            <label for="transaction_date" class="form-label">{{ __('Date') }}</label>
            <input type="date" max="{{ date("Y-m-d") }}" name="transaction_date" class="form-control" value="{{ isset($financial) ? $financial->transaction_date : date("Y-m-d") }}" id="transaction_date" >
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

