<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::table('users_roles')
            ->join('roles', 'users_roles.role_id', '=', 'roles.id')
            ->get();
        $users = User::orderBy('id', 'asc')->paginate(10);
        view()->share('roles', $roles);

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'first_name' => 'required',
            'name' => 'required',
            'national_register' => 'required',
            'contract_start_date' => 'required',
        ]);

        //Create setting
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        $user->gsm = $request->input('gsm');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->birth_date = $request->input('birth_date');
        $user->national_register = $request->input('national_register');
        $user->contract_start_date = $request->input('contract_start_date');
        $user->color = $request->input('color');
        $user->save();

        return redirect('/users')->with('succes', 'Nieuwe gebruiker toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = DB::table('users_roles')
            ->join('roles', 'users_roles.role_id', '=', 'roles.id')
            ->where('user_id', $id)
            ->first();
        // $test = Role::with('users')->where('user_id', $id)->first();
        $user = User::find($id);
        view()->share('role', $role);

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'name' => 'required',
            'national_register' => 'required',
            'contract_start_date' => 'required',
        ]);

        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        $user->gsm = $request->input('gsm');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->birth_date = $request->input('birth_date');
        $user->national_register = $request->input('national_register');
        $user->contract_start_date = $request->input('contract_start_date');
        $user->color = $request->input('color');
        $user->save();

        return redirect('/users')->with('succes', 'De gebruiker werd aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('succes', 'De gebruiker werd verwijderd');
    }
}
