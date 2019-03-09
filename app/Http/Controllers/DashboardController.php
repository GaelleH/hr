<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;
use App\AbsenceDate;
use App\User;
use Carbon\Carbon;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function index() {
        $remaining = User::leftJoin('absences_years', 'users.id', '=', 'absences_years.user_id')
            ->where('absences_years.year', '=', Carbon::now()->year)
            ->select('users.id', 'absences_years.official_leave_hours_remaining')
            ->first();
        view()->share('remaining', $remaining);
        
        $absence = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absences_years', 'absences.absences_year_id', '=', 'absences_years.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->where('absences.status', '=', 1)
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absences.remarks', 'absences.status', 'absences_years.year', 'absence_types.name', 'absences.user_id')
            ->take(5)
            ->get();
        view()->share('absence', $absence);

        $myAbsence = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->where('absences.user_id', '=', Auth::user()->id)
            ->where('absences.status', '=', 2)
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absences.remarks', 'absences.status', 'absence_types.name', 'absences.user_id')
            ->take(5)
            ->get();
        view()->share('myAbsence', $myAbsence);

        $now = Carbon::now();
        $start = Carbon::now()->startOfWeek();
        $startMonth = Carbon::now()->startOfMonth()->format('d/m');
        $end = Carbon::now()->endOfWeek();
        $endMonth = Carbon::now()->endOfMonth()->format('d/m');

        $dates = AbsenceDate::leftJoin('absences', 'absence_dates.absence_id', '=', 'absences.id')
            ->leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->whereBetween('absence_dates.date', [$start,$end])
            ->where('absences.status', '=', 2)
            ->orderBy('absence_dates.date', 'asc')
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absence_dates.date')
            ->get();            
        view()->share('dates', $dates);

        $users = User::whereBetween(DB::raw('MONTH(birth_date)'), [Carbon::today()->month,Carbon::today()->month+1])
            ->get();
        view()->share('users', $users);

        return view('dashboard.index');
    }
}
