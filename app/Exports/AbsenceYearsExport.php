<?php

namespace App\Exports;

use App\AbsencesYear;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;


class AbsenceYearsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function query()
    {
        return AbsencesYear::query()
            ->where('year', $this->year)
            ->select('id','year', 'official_leave_hours', 'official_leave_hours_remaining', 'official_leave_hours_scheduled','user_id')
            ->with('users:id,first_name');
    }

    public function headings(): array
    {
        return [
            '#',
            'Jaar',
            'Verlofuren',
            'Overige verlofuren',
            'Geplande verlofuren',
            'Werknemer',
        ];
    }

    /**
    * @var AbsencesYear $absencesYear
    */
    public function map($absencesYear): array
    {
        return [
            $absencesYear->id,
            $absencesYear->year,
            $absencesYear->official_leave_hours,
            $absencesYear->official_leave_hours_remaining,
            $absencesYear->official_leave_hours_scheduled,
            $absencesYear->user->first_name,
        ];
    }
}
