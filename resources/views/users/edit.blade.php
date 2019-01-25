@extends('layouts.back')

@section('sidebar')
<ul class="nav">
    <li>
        <a href="{{ route('dashboard')}}">
            <i class="pe-7s-graph"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('users.index')}}">
            <i class="pe-7s-users"></i>
            <p>Gebruikers</p>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.messages')
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Nieuwe gebruiker</h4>
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
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Achternaam" value="{{ $user->name }}">
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
                                    <div class="form-group">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rol</label>
                                    </div>
                                </div>
                            </div>
        
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