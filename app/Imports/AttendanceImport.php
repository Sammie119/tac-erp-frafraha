<?php

namespace App\Imports;

use App\Models\StaffAttendanceDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AttendanceImport implements ToModel,WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private function dateConvertor($date): string
    {
        if(is_int($date)){
            return date("Y-m-d H:i:s", $date);
        }
        return $date;
    }

    public function model(array $row)
    {
        return new StaffAttendanceDetail([
            'staff_number' => $row['staff_number'],
            'attendance_date' => $this->dateConvertor($row['attendance_date']),
            'checkin_time' => $this->dateConvertor($row['checkin_time']),
            'departure_time' => $this->dateConvertor($row['departure_time']),
            'division' => get_logged_user_division_id(),
            'created_by_id' => get_logged_in_user_id(),
            'updated_by_id' => get_logged_in_user_id(),
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'staff_number' => 'required|integer|exists:staff,staff_number',
            'attendance_date' => 'required',
            'checkin_time' => 'required',
            'departure_time' => 'required',
        ];
    }
}
