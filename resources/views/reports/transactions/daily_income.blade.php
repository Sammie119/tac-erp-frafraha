<form method="POST" action="daily_income_report">
    @csrf

    {{--    <h4>Select Date Range</h4>--}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label for="fromDate" class="form-label">{{ __('From Date') }}</label>
            <input type="date" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" name="from_date" id="fromDate" class="form-control" required autofocus>
        </div>
        <div class="col-md-6">
            <label for="toDate" class="form-label">{{ __('To Date') }}</label>
            <input type="date" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" name="to_date" id="toDate" class="form-control" required>
        </div>

        <div class="col-md-12">
            <label for="select" class="form-label">{{ __('Shop Location') }}</label>
            {{--            <select class="form-control" name="location" required>--}}
            {{--                <option selected value="All">All</option>--}}
            {{--                <option value="49">Stores - Fafraha</option>--}}
            {{--                <option value="50">Stores - HQ</option>--}}
            {{--            </select>--}}
            {{--            <input type="text" name="to_date" id="toDate" >--}}
        </div>
        <div class="col-md-12">
            <x-input-select
                :options="['All', 'Stores - Fafraha', 'Stores - HQ']"
                :selected="isset($period) ? $period->status : 0"
                :values="['All', 49, 50]"
                :type="1"
                name="location"
                required
            />
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </div>
</form>

