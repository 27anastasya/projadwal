<?php

namespace App\Exports;

use App\Models\Positions;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPosition implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Positions::all();
    }
}
