<?php

namespace App\Exports;

use App\Models\Positions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPositions implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Positions::all();
    }

    public function headings(): array
    {
        return ["id", "name", "keterangan", "singkatan", "created_at", "update"];
    }
}
