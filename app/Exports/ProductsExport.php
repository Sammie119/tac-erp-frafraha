<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithStyles
{
    public int $user;
    public function __construct(int $user)
    {
        $this->user = $user;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Products::select('products.name as name', 'description', 'system_l_o_v_s.name as product_type', 'stock_in', 'stock_out', 'cost', 'price')
            ->join('system_l_o_v_s', 'products.type', '=', 'system_l_o_v_s.id')
            ->where('division', $this->user)->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['name', 'description', 'product_type', 'stock_in', 'stock_out', 'cost', 'price'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
//            2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
//            'A1' => ['font' => ['size' => 16]],
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
