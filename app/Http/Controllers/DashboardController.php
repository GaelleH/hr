<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absence;

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

        return view('dashboard.index');
    }
}
