<form method="POST" action="attendance_store" enctype= multipart/form-data>
    @csrf

    <div class="row mb-3">
        <div class="col-md-6 mb-3">
            <label for="report_month" class="col-md-12 col-form-label">{{ __('Attendance Month') }}</label>

            <div class="col-md-12">
                <x-input-select
                    :options="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']"
                    :selected="isset($period) ? $period->status : 0"
                    :values="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']"
                    :type="1"
                    name="att_month"
                    required
                />
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="report_month" class="col-md-12 col-form-label">{{ __('Attendance Year') }}</label>

            <div class="col-md-12">
                <?php
                    $years = [];
                    for($i = 2022 ; $i <= date('Y'); $i++){
                        $years[] = $i;
                    }
                ?>
                <x-input-select
                    :options="$years"
                    :selected="date('Y')"
                    :values="$years"
                    :type="1"
                    name="att_year"
                    required
                />
            </div>
        </div>
        <div class="col-sm-12">
            <label for="report_month" class="col-md-12 col-form-label">{{ __('Select File') }}</label>
            <input type="file" name="file" id="file" class="form-control" required autofocus autocomplete="file">
        </div>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

