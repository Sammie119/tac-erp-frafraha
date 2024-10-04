<form method="POST" action="attendance_store" enctype= multipart/form-data>
    @csrf

    <div class="row mb-3">
        <div class="col-md-6 mb-3">
            <label for="report_month" class="col-md-12 col-form-label">{{ __('Attendance Month') }}</label>

            <div class="col-md-12">
                <select class="form-control" name="att_month" required>
                    <option value="" selected disabled>--Select Month--</option>
                    <option {{ (date('m') === '01') ? 'selected' : null }}>January</option>
                    <option {{ (date('m') === '02') ? 'selected' : null }}>February</option>
                    <option {{ (date('m') === '03') ? 'selected' : null }}>March</option>
                    <option {{ (date('m') === '04') ? 'selected' : null }}>April</option>
                    <option {{ (date('m') === '05') ? 'selected' : null }}>May</option>
                    <option {{ (date('m') === '06') ? 'selected' : null }}>June</option>
                    <option {{ (date('m') === '07') ? 'selected' : null }}>July</option>
                    <option {{ (date('m') === '08') ? 'selected' : null }}>August</option>
                    <option {{ (date('m') === '09') ? 'selected' : null }}>September</option>
                    <option {{ (date('m') === '10') ? 'selected' : null }}>October</option>
                    <option {{ (date('m') === '11') ? 'selected' : null }}>November</option>
                    <option {{ (date('m') === '12') ? 'selected' : null }}>December</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="report_month" class="col-md-12 col-form-label">{{ __('Attendance Year') }}</label>

            <div class="col-md-12">
                <select class="form-control" name="att_year" required>
                    <option value="" selected disabled>--Select Year--</option>
                    <?php
                    for($i = 2022 ; $i <= date('Y'); $i++){
                        $thisYear = (date('Y') == $i) ? 'selected' : null;
                        echo "<option ". $thisYear .">$i</option>";
                    }
                    ?>
                </select>
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

