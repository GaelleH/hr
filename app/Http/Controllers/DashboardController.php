<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;
use App\AbsenceDate;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index() {
        $absence = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absences_years', 'absences.absences_year_id', '=', 'absences_years.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->where('absences.status', '=', 1)
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absences.remarks', 'absences.status', 'absences_years.year', 'absence_types.name', 'absences.user_id')
            ->take(5)
            ->get();
        view()->share('absence', $absence);

        $now = Carbon::now();
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();

        $dates = AbsenceDate::leftJoin('absences', 'absence_dates.absence_id', '=', 'absences.id')
            ->leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->whereBetween('absence_dates.date', [$start,$end])
            ->where('absences.status', '=', 2)
            ->orderBy('absence_dates.date', 'asc')
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absence_dates.date')
            ->get();            
        view()->share('dates', $dates);

        return view('dashboard.index');
    }
}
