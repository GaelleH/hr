<?php

namespace App\Http\Controllers;

use App\AbsenceType;
use App\Absence;
use App\AbsenceDate;
use App\User;
use App\AbsencesYear;
use App\Http\Requests\StoreAbsenceRequest;
// use Illuminate\Http\Request;
use Request;
use DB;
use Auth;


class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $s = Request::input('s');
        $absences = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absences_years', 'absences.absences_year_id', '=', 'absences_years.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absences_years.year', 'absence_types.name')
            ->search($s)
            ->paginate(10);
        view()->share('s', $s);

        return view('absence.index')->with('absences', $absences);
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

        $data = Request::all();
        
        foreach ($data['rows'] as $row) {
            $items = new AbsenceDate([
                'absence_id' => $absence->id,
                'date' => $row['date'],
                'number_of_hours' => $row['number_of_hours'],
            ]);
            $items->save();
        }

        return redirect('/absence')->with('succes', 'Een nieuw aanvraag werd toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $absence = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absences_years', 'absences.absences_year_id', '=', 'absences_years.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->where('absences.id', '=', $id)
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absences.remarks', 'absences.status', 'absences_years.year', 'absence_types.name')
            ->first();

        $dates = DB::table('absence_dates')
            ->where('absence_id', '=', $id)
            ->get();
        view()->share('dates', $dates);

        return view('absence.show')->with('absence', $absence);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $absence = Absence::find($id);
        $users = User::all();
        $years = AbsencesYear::with('users')->where('user_id', auth::user()->id)->get();
        $types = AbsenceType::all();
        view()->share('users', $users);
        view()->share('years', $years);
        view()->share('types', $types);

        return view('absence.edit')->with('absence', $absence);
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
