<?php

namespace App\Http\Controllers;

use App\AbsenceType;
use App\Absence;
use App\AbsenceDate;
use App\User;
use App\AbsencesYear;
use App\Http\Requests\StoreAbsenceRequest;
use Illuminate\Http\Request;
use DB;
use Auth;


class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absence.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        view()->share('users', $users);
        $years = AbsencesYear::with('users')->where('user_id', auth::user()->id)->first();
        view()->share('years', $years);
        $types = AbsenceType::all();
        view()->share('types', $types);

        return view('absence.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbsenceRequest $request)
    {
        $validated = $request->validated();

        //Create setting
        $absence = new Absence;
        $absence->absence_type_id = $request->input('absence_type_id');
        $absence->absences_year_id = $request->input('absences_year_id');
        $absence->remarks = $request->input('remarks');
        $absence->user_id = $request->input('user_id');
        $absence->status = 1;
        $absence->save();

        $input = Input::all();
        dump($input);die;

        foreach ($input['rows'] as $row) {
            $items = new AbsenceDate([
                'date' => $row['date'],
                'number_of_hours' => $row['number_of_hours'],
            ]);
            $items->save();
        }

        return redirect('/absence')->with('succes', 'Een nieuw verlofjaar werd toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function show(AbsenceType $absenceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsenceType $absenceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsenceType $absenceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsenceType $absenceType)
    {
        //
    }
}
