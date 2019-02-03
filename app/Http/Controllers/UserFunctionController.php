<?php

namespace App\Http\Controllers;

use App\UserFunction;
use Illuminate\Http\Request;
use DB;

class UserFunctionController extends Controller
{
    //TODO: make pivot table
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $functions = UserFunction::orderBy('id', 'asc')->paginate(10);
        
        return view('functions.index')->with('functions', $functions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('functions.create');
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
        $function = new UserFunction;
        $function->name = $request->input('name');
        $function->save();

        return redirect('/user_functions')->with('succes', 'Nieuwe functie toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserFunction  $userFunction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $function = UserFunction::find($id);

        return view('functions.show')->with('function', $function);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserFunction  $userFunction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $function = UserFunction::find($id);

        return view('functions.edit')->with('function', $function);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserFunction  $userFunction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $function = UserFunction::find($id);
        $function->name = $request->input('name');
        $function->save();

        return redirect('/user_functions')->with('succes', 'De functie werd aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserFunction  $userFunction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $function = UserFunction::find($id);
        $function->delete();

        return redirect('/user_functions')->with('succes', 'De functie werd verwijderd');
    }
}
