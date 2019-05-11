<?php

namespace App\Exports;

use App\Absence;
use App\AbsenceDate;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Auth;

class AbsencesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function __construct(int $userId)
    {
        $this->user_id = $userId;
    }

    public function query()
    {
        return Absence::query()
            ->with('absenceDates')
            ->where('status', '=', '3')
            ->where('user_id', $this->user_id)
            ->select('id','absence_type_id', 'absences_year_id', 'remarks', 'extra_remarks', 'user_id')
            ->with('absenceType:id,name', 'absencesYear:id,year', 'user:id,first_name');
    }

    public function headings(): array
    {
        return [
            '#',
            'Afwezigheidstype',
            'Verlofjaar',
            'Opmerkingen',
            'Extra opmerkingen',
            'Werknemer',
            'Datum',
            'Aantal uren',
        ];
    }

    /**
    * @var Absence $absence
    */
    public function map($absence): array
    {
        $data = [];
        
        foreach($absence->absenceDates as $date) {
            $data[] = [
                $absence->id,
                $absence->absenceType->name,
                $absence->absencesYear->year,
                $absence->remarks,
                $absence->extra_remarks,
                $absence->user->first_name,
                $date->date,
                $date->number_of_hours,
            ];
        }
        return $data;
    }
}
