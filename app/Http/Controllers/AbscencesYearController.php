<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AbsenceYearUpdateRequest;
use App\AbsencesYear;
use App\User;
use App\UserFunction;
use DB;


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
    public function store(AbsenceYearUpdateRequest $request)
    {
        $validated = $request->validated();

        //Create setting
        $year = new AbsencesYear;
        $year->official_leave_hours = $request->input('official_leave_hours');
        $year->user_id = $request->input('user_id');
        $year->year = $request->input('year');
        $year->extra_leave_hours = $request->input('extra_leave_hours');
        $year->save();

        return redirect('/absences')->with('succes', 'Een nieuw verlofjaar werd toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function show(AbsencesYear $absencesYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsencesYear $absencesYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsencesYear $absencesYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsencesYear  $absencesYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsencesYear $absencesYear)
    {
        //
    }
}
