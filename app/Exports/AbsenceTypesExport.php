<?php

namespace App\Exports;

use App\AbsenceType;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsenceTypesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AbsenceType::all();
    }
}
