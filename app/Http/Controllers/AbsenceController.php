<?php

namespace App\Http\Controllers;

use App\AbsenceType;
use App\Absence;
use App\AbsenceDate;
use App\User;
use App\AbsencesYear;
use App\Http\Requests\StoreAbsenceRequest;
use App\Http\Requests\UpdateAbsenceRequest;
// use Illuminate\Http\Request;
use Request;
use DB;
use Auth;
use Mail;


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
            ->select('absences.id', 'absences.status', 'users.first_name', 'users.last_name', 'absences_years.year', 'absence_types.name')
            ->search($s)
            ->orderBy('absences.status', 'DESC')
            ->paginate(10);
        view()->share('s', $s);

        foreach ($absences as $absence){
            $dates = AbsenceDate::where('absence_id', '=', $absence->id)
                ->pluck('date')
                // ->get()
                ->toArray();
            $test[$absence->id] = implode(" - ", $dates);
            view()->share('test', $test);
        }
        

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
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absences.remarks', 'absences.status', 'absences_years.year', 'absence_types.name', 'absences.user_id')
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
        $dates = DB::table('absence_dates')
            ->where('absence_id', '=', $id)
            ->get();
        view()->share('users', $users);
        view()->share('years', $years);
        view()->share('types', $types);
        view()->share('dates', $dates);

        return view('absence.edit')->with('absence', $absence);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbsenceRequest $request, $id)
    {
        $absence = Absence::find($id);
        $absence->absence_type_id = $request->input('absence_type_id');
        $absence->absences_year_id = $request->input('absences_year_id');
        $absence->remarks = $request->input('remarks');
        $absence->user_id = $request->input('user_id');
        $absence->save();

        $data = Request::all();
        
        $dates = DB::table('absence_dates')
            ->where('absence_id', '=', $id)
            ->get();

        foreach ($data['rows'] as $row) {
            foreach ($dates as $date) {
                if ($absence->id === $date->absence_id && $row['date'] === $date->date) {
                    $d = DB::table('absence_dates')
                                ->where('absence_id', '=', $absence->id)
                                ->where('date', '=', $row['date'])
                                ->first();
                    $item = AbsenceDate::find($d->id);
                    $item->date = $row['date'];
                    $item->number_of_hours = $row['number_of_hours'];
                    $item->save();
                } else {
                    $items = new AbsenceDate([
                        'absence_id' => $absence->id,
                        'date' => $row['date'],
                        'number_of_hours' => $row['number_of_hours'],
                        ]);
                    $items->save();
                }
            }
        }

        return redirect('/absence')->with('succes', 'De afwezigheid werd aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dates = DB::table('absence_dates')
            ->where('absence_id', '=', $id)
            ->get();
        
        foreach ($dates as $date) {
            $test = AbsenceDate::find($date->id);
            $test->delete();
        }

        $absence = Absence::find($id);
        $absence->delete();

        return redirect('/absence')->with('succes', 'Het afwezigheidstype werd verwijderd');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myAbsence()
    {
        $s = Request::input('s');
        $absences = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absences_years', 'absences.absences_year_id', '=', 'absences_years.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->where('absences.user_id', '=', Auth::user()->id)
            ->select('absences.id', 'absences.status', 'users.first_name', 'users.last_name', 'absences_years.year', 'absence_types.name')
            ->search($s)
            ->orderBy('absences.status', 'DESC')
            ->paginate(10);
        view()->share('s', $s);

        foreach ($absences as $absence){
            $dates = AbsenceDate::where('absence_id', '=', $absence->id)
                ->pluck('date')
                // ->get()
                ->toArray();
            $test[$absence->id] = implode(" - ", $dates);
            view()->share('test', $test);
        }

        return view('absence.my_absence')->with('absences', $absences);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unapprovedAbsences()
    {
        $s = Request::input('s');
        $absences = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absences_years', 'absences.absences_year_id', '=', 'absences_years.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->where('absences.status', '=', '1')
            ->select('absences.id', 'absences.status', 'absences.created_at', 'users.first_name', 'users.last_name', 'absences_years.year', 'absence_types.name')
            ->search($s)
            ->orderBy('absences.created_at', 'ASC')
            ->paginate(10);
        view()->share('s', $s);

        foreach ($absences as $absence){
            $dates = AbsenceDate::where('absence_id', '=', $absence->id)
                ->pluck('date')
                // ->get()
                ->toArray();
            $test[$absence->id] = implode(" - ", $dates);
            view()->share('test', $test);
        }

        return view('absence.unapproved')->with('absences', $absences);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function absence($id)
    {
        $absence = Absence::leftJoin('users', 'absences.user_id', '=', 'users.id')
            ->leftJoin('absences_years', 'absences.absences_year_id', '=', 'absences_years.id')
            ->leftJoin('absence_types', 'absences.absence_type_id', '=', 'absence_types.id')
            ->where('absences.id', '=', $id)
            ->select('absences.id', 'users.first_name', 'users.last_name', 'absences.remarks', 'absences.status', 'absences_years.year', 'absence_types.name', 'absences.user_id')
            ->first();

        $dates = DB::table('absence_dates')
            ->where('absence_id', '=', $id)
            ->get();
        view()->share('dates', $dates);

        return view('absence.absence')->with('absence', $absence);
    }

    /**
     * change status to approved the specified resource from storage.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function approved($id)
    {
        $absence = Absence::find($id);
        // $absence->status = 2;
        // $absence->save();

        //todo reduce dates

        $dates = AbsenceDate::where('absence_id', '=', $id)->get();

        $year = AbsencesYear::where('user_id', '=', $absence->user_id)->first();
        foreach ($dates as $date) {
            $test = $year->official_leave_hours_remaining - $date->number_of_hours;
            dump($test);die;
        }
        
        $user = User::where('id', '=', $absence->user_id)->first();
    
        $mail = $user->email;
        $name = $user->first_name;
        
        $data = array(
            'email' => $mail,
            'name' => $name
        );
        // Path or name to the blade template to be rendered
        $template_path = 'request_approved';
        
        Mail::send($template_path, $data, function($message) use ($mail, $name) {
            // Set the receiver and subject of the mail.
            $message->to($mail, $name)->subject('Uw verlofaanvraag werd goedgekeurd');
            // Set the sender
            $message->from('gaelle_hardy1@hotmail.com','HR');
        });

        return redirect('/unapproved-absence')->with('succes', 'De aanvraag werd goedgekeurd');
    }

    /**
     * change status to not approved the specified resource from storage.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function notApproved($id)
    {
        $absence = Absence::find($id);
        $absence->status = 3;
        $absence->save();

        return redirect('/unapproved-absence')->with('succes', 'De aanvraag werd afgekeurd');
    }
}
