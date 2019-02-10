<?php

namespace App\Http\Controllers;

use App\AbsenceType;
use Illuminate\Http\Request;
use DB;

class AbsenceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s = $request->input('s');
        $types = AbsenceType::orderBy('id', 'asc')
            ->search($s)
            ->paginate(10);

        view()->share('s', $s);
        return view('absenceTypes.index')->with('types', $types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = AbsenceType::all();
        view()->share('types', $types);

        return view('absenceTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        //Create setting
        $type = new AbsenceType;
        $type->name = $request->input('name');
        $type->save();

        return redirect('/absence-types')->with('succes', 'Nieuw afwezigheidstype toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = AbsenceType::find($id);

        return view('absenceTypes.show')->with('type', $type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = AbsenceType::find($id);

        return view('absenceTypes.edit')->with('type', $type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $type = AbsenceType::find($id);
        $type->name = $request->input('name');
        $type->save();

        return redirect('/absence-types')->with('succes', 'Het afwezigheidstype werd aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsenceType  $absenceType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = AbsenceType::find($id);
        $type->delete();

        return redirect('/absence-types')->with('succes', 'Het afwezigheidstype werd verwijderd');
    }
}
