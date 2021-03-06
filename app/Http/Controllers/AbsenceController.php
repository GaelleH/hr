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
use Redirect;
use App\Exports\AbsencesExport;
use App\Exports\AbsencesGeneralExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


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
        $allYears = AbsencesYear::leftJoin('users', 'absences_years.user_id', '=', 'users.id')
            ->select('absences_years.id', 'absences_years.year', 'users.first_name', 'users.last_name')
            ->get();
        view()->share('allYears', $allYears);
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

        $remaining = AbsencesYear::where('id', '=', $request->input('absences_year_id'))
            ->first();

        $data = Request::all();
        $cal = 0;

        foreach ($data['rows'] as $row) {
            $cal += $row['number_of_hours'];

            if ($remaining->official_leave_hours_remaining > $cal) {
                //Create setting
                $absence = new Absence;
                $absence->absence_type_id = $request->input('absence_type_id');
                $absence->absences_year_id = $request->input('absences_year_id');
                $absence->remarks = $request->input('remarks');
                $absence->user_id = $request->input('user_id');
                $absence->status = 1;
                $absence->save();

                $items = new AbsenceDate([
                    'absence_id' => $absence->id,
                    'date' => $row['date'],
                    'number_of_hours' => $row['number_of_hours'],
                ]);
                $items->save();
            } else {
                return redirect()->back()->with('error', 'Er zijn niet voldoende overige uren om deze aanvraag in te dienen.');
            }
        }

        // $users = DB::table('role_user')
        //     ->leftJoin('users', 'role_user.user_id', '=', 'users.id')
        //     ->where('role_user.role_id', '=', 2)
        //     ->select('role_user.role_id', 'users.first_name', 'users.last_name', 'users.email')
        //     ->get();

        // foreach ($users as $user) {

        //     $mail = $user->email;
        //     $name = $user->first_name;
            
        //     $data = array(
        //         'email' => $mail,
        //         'name' => $name,
        //         'remark' => $absence->extra_remarks,
        //     );
        //     // Path or name to the blade template to be rendered
        //     $template_path = 'request_new';
            
        //     Mail::send($template_path, $data, function($message) use ($mail, $name) {
        //         // Set the receiver and subject of the mail.
        //         $message->to($mail, $name)->subject('Nieuwe verlofaanvraag');
        //         // Set the sender
        //         $message->from('gaelle_hardy1@hotmail.com','HR');
        //     });
        // }

        foreach(Auth::user()->roles as $role) {
            if ($role->id === 3) {
                return redirect('/my-absence')->with('succes', 'Een nieuw aanvraag werd toegevoegd');
            } else {
                return redirect('/absence')->with('succes', 'Een nieuw aanvraag werd toegevoegd');
            }
        }
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
        dump($years);
        $allYears = AbsencesYear::leftJoin('users', 'absences_years.user_id', '=', 'users.id')
            ->select('absences_years.id', 'absences_years.year', 'users.first_name', 'users.last_name')
            ->get();
        $types = AbsenceType::all();
        $dates = DB::table('absence_dates')
            ->where('absence_id', '=', $id)
            ->get();
        view()->share('users', $users);
        view()->share('years', $years);
        view()->share('allYears', $allYears);
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

        foreach(Auth::user()->roles as $role) {
            if ($role->id === 3) {
                return redirect('/my-absence')->with('succes', 'De afwezigheid werd aangepast');
            } else {
                return redirect('/absence')->with('succes', 'De afwezigheid werd aangepast');
            }
        }
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

        return redirect('/absence')->with('succes', 'Het afwezighei werd verwijderd');
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

        $year = AbsencesYear::where('user_id', '=', Auth::user()->id)->first();
        view()->share('year', $year);

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
    public function approved(Request $request, $id)
    {
        $absence = Absence::find($id);
        $absence->status = 2;
        $absence->save();

        $yearId = $absence->absences_year_id;
        $year = AbsencesYear::where('id', '=', $yearId)
            ->first();
        $numberOfHoursScheduled = 0;

        $absencesQuery = Absence::join('absence_dates', 'absences.id', '=', 'absence_dates.absence_id')
            ->where('absences.user_id', '=', $absence->user_id)
            ->where('absences.absences_year_id', '=', $yearId)
            ->where('absences.status', '=', 2)
            ->select('absences.id', 'absence_dates.number_of_hours')
            ->get();
        
        foreach ($absencesQuery as $a) {
            $numberOfHoursScheduled += $a->number_of_hours;
        }

        if ($numberOfHoursScheduled > 0) {
            $year->official_leave_hours_scheduled = $numberOfHoursScheduled;
            $year->official_leave_hours_remaining = $year->official_leave_hours - $numberOfHoursScheduled;
            $year->save();
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
        $absence->extra_remarks = Request::input('extra_remarks');
        $absence->save();

        $user = User::where('id', '=', $absence->user_id)->first();
    
        $mail = $user->email;
        $name = $user->first_name;
        
        $data = array(
            'email' => $mail,
            'name' => $name,
            'remark' => $absence->extra_remarks,
        );
        // Path or name to the blade template to be rendered
        $template_path = 'request_disapproved';
        
        Mail::send($template_path, $data, function($message) use ($mail, $name) {
            // Set the receiver and subject of the mail.
            $message->to($mail, $name)->subject('Uw verlofaanvraag werd afgekeurd');
            // Set the sender
            $message->from('gaelle_hardy1@hotmail.com','HR');
        });

        return redirect('/unapproved-absence')->with('succes', 'De aanvraag werd afgekeurd');
    }

    /**
     * export a file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export() 
    {
        return Excel::download(new AbsencesExport(Auth::user()->id), 'absences.xlsx');
    }

    /**
     * export a file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportThisYear() 
    {
        return Excel::download(new AbsencesGeneralExport, 'absences_this_year.xlsx');
    }
}
