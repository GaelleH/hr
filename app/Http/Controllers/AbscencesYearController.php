<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AbsenceYearStoreRequest;
use App\Http\Requests\AbsenceYearUpdateRequest;
use App\AbsencesYear;
use App\User;
use App\UserFunction;
use DB;
use App\Exports\AbsenceYearsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AbscencesYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //TODO:make pivot table
        $s = $request->input('s');
        $years = AbsencesYear::with('users')
            ->search($s)
            ->orderBy('id', 'asc')
            ->paginate(10);

        view()->share('s', $s);
        return view('abscences.index')->with('years', $years);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $years = AbsencesYear::all();
        view()->share('years', $years);
        view()->share('users', $users);

        return view('abscences.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenceYearStoreRequest $request)
    {
        $validated = $request->validated();

        //Create setting
        $year = new AbsencesYear;
        $year->official_leave_hours = $request->input('official_leave_hours');
        $year->official_leave_hours_remaining = $request->input('official_leave_hours');
        $year->year = $request->input('year');
        $year->user_id = $request->input('user_id');
        $year->save();

        $year->users()->attach($request->user_id);

        return redirect('/absences')->with('succes', 'Een nieuw verlofjaar werd toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $year = AbsencesYear::with('users')->find($id);

        return view('abscences.show')->with('year', $year);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $year = AbsencesYear::with('users')->find($id);
        $users = User::all();

        view()->share('users', $users);

        return view('abscences.edit')->with('year', $year);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function update(AbsenceYearUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        $year = AbsencesYear::find($id);
        $year->users()->detach();
        $year->official_leave_hours = $request->input('official_leave_hours');
        $year->year = $request->input('year');
        $year->user_id = $request->input('user_id');
        $year->save();

        // $role = Role::with('users')->where('user_id', $id)->get();

        $year->users()->attach($request->user_id);

        return redirect('/absences')->with('succes', 'Het verlofjaar werd aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year = AbsencesYear::find($id);
        $year->delete();

        return redirect('/absences')->with('succes', 'Het verlofjaar werd verwijderd');
    }

    /**
     * export a file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportThisYear() 
    {
        return Excel::download(new AbsenceYearsExport(Carbon::now()->year), 'absenceYears'.Carbon::now()->year.'.xlsx');
    }

    /**
     * export a file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportLastYear() 
    {
        return Excel::download(new AbsenceYearsExport(Carbon::now()->subYears(1)->year), 'absenceYears'.Carbon::now()->subYears(1)->year.'.xlsx');
    }
}
