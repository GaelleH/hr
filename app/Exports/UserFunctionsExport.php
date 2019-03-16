<?php

namespace App\Exports;

use App\UserFunction;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserFunctionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserFunction::all();
    }
}
