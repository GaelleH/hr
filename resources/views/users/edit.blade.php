@extends('layouts.back')

@section('sidebar')
@role('developer')
<ul class="nav">
    <li>
        <a href="{{ route('dashboard')}}">
            <i class="pe-7s-graph"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li>
        <a href="{{ route('absence.index')}}">
            <i class="pe-7s-sun"></i>
            <p>Afwezigheden</p>
        </a>
    </li>
    <li>
        <a href="{{ route('myAbsence')}}">
            <i class="pe-7s-date"></i>
            <p>Mijn afwezigheden</p>
        </a>
    </li>
    <li>
        <a href="{{ route('absences.index')}}">
            <i class="pe-7s-drawer"></i>
            <p>Verlofjaren</p>
        </a>
    </li>
    <li>
        <a href="{{ route('absence-types.index')}}">
            <i class="pe-7s-ticket"></i>
            <p>Afwezigheidstypes</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('users.index')}}">
            <i class="pe-7s-users"></i>
            <p>Gebruikers</p>
        </a>
    </li>
    <li>
        <a href="{{ route('user_functions.index')}}">
            <i class="pe-7s-headphones"></i>
            <p>Functies</p>
        </a>
    </li>
</ul>
@endrole
@role('management')
<ul class="nav">
    <li>
        <a href="{{ route('dashboard')}}">
            <i class="pe-7s-graph"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li>
        <a href="{{ route('absence.index')}}">
            <i class="pe-7s-sun"></i>
            <p>Afwezigheden</p>
        </a>
    </li>
    <li>
        <a href="{{ route('myAbsence')}}">
            <i class="pe-7s-date"></i>
            <p>Mijn afwezigheden</p>
        </a>
    </li>
    <li>
        <a href="{{ route('absences.index')}}">
            <i class="pe-7s-drawer"></i>
            <p>Verlofjaren</p>
        </a>
    </li>
    <li>
        <a href="{{ route('absence-types.index')}}">
            <i class="pe-7s-ticket"></i>
            <p>Afwezigheidstypes</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('users.index')}}">
            <i class="pe-7s-users"></i>
            <p>Gebruikers</p>
        </a>
    </li>
    <li>
        <a href="{{ route('user_functions.index')}}">
            <i class="pe-7s-headphones"></i>
            <p>Functies</p>
        </a>
    </li>
</ul>
@endrole
@role('employee')
<ul class="nav">
    <li>
        <a href="{{ route('dashboard')}}">
            <i class="pe-7s-graph"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li>
        <a href="{{ route('myAbsence')}}">
            <i class="pe-7s-date"></i>
            <p>Mijn afwezigheden</p>
        </a>
    </li>
    <li>
        <a href="{{ route('absence-types.index')}}">
            <i class="pe-7s-ticket"></i>
            <p>Afwezigheidstypes</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('users.index')}}">
            <i class="pe-7s-users"></i>
            <p>Gebruikers</p>
        </a>
    </li>
</ul>
@endrole
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.messages')
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Gebruiker aanpassen</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('users.update', $user) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT')}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Voornaam</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Voornaam" value="{{ $user->first_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Achternaam</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Achternaam" value="{{ $user->last_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefoonnummer</label>
                                        <input type="text" class="form-control" name="tel" id="tel" placeholder="Telefoonnummer" value="{{ $user->tel }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gsmnummer</label>
                                        <input type="text" class="form-control" name="gsm" id="gsm" placeholder="Gsmnummer" value="{{ $user->gsm }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- <div class="form-group">
                                        <label>Paswoord</label>
                                        @if (Auth::user()->id == $user->id)
                                        <div>
                                            <a href="../../changePassword" class="btn btn-default btn-fill">Verander paswoord</a>
                                        </div>
                                        @else
                                        <div>
                                            <small>
                                                Paswoord kan enkel aangepast worden door de gebruiker
                                            </small>
                                        </div>
                                        @endif
                                    </div> --}}
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Paswoord">
                                        <small>Laat dit veld leeg om het paswoord niet te veranderen.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Geboortedatum</label>
                                        <input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="Geboortedatum" value="{{ $user->birth_date }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Rijksregister</label>
                                        <input type="text" class="form-control" name="national_register" id="national_register" placeholder="Rijksregister" value="{{ $user->national_register }}">
                                    </div>
                                </div>
                            </div>
                            @role('management')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contractdatum</label>
                                        <input type="date" class="form-control" name="contract_start_date" id="contract_start_date" value="{{ $user->contract_start_date }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kleur</label>
                                        <input type="text" class="form-control" name="color" id="color" placeholder="Kleur" value="{{ $user->color }}">
                                    </div>
                                </div>
                            </div>
                            @endrole
                            @role('developer')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contractdatum</label>
                                        <input type="date" class="form-control" name="contract_start_date" id="contract_start_date" value="{{ $user->contract_start_date }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kleur</label>
                                        <input type="text" class="form-control" name="color" id="color" placeholder="Kleur" value="{{ $user->color }}">
                                    </div>
                                </div>
                            </div>
                            @endrole
                            @role('management')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                            @foreach ($roles as $role)
                                                @foreach ($user->roles as $r)
                                                    <option value="{{ $role->id }}" @if ($r->id == $role->id) selected @endif>{{ $role->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Functie</label>
                                        <select class="form-control" name="user_function_id" id="user_function_id">
                                            @foreach ($functions as $function)
                                            <option value="{{ $function->id }}" @if ($user->user_function_id == $function->id) selected @endif>{{ $function->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endrole
                            @role('developer')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                            @foreach ($roles as $role)
                                                @foreach ($user->roles as $r)
                                                    <option value="{{ $role->id }}" @if ($r->id == $role->id) selected @endif>{{ $role->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Functie</label>
                                        <select class="form-control" name="user_function_id" id="user_function_id">
                                            @foreach ($functions as $function)
                                            <option value="{{ $function->id }}" @if ($user->user_function_id == $function->id) selected @endif>{{ $function->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endrole
        
                            <button type="submit" class="btn btn-info btn-fill pull-right">Opslaan</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection