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
    <li>
        <a href="{{ route('user_functions.index')}}">
            <i class="pe-7s-headphones"></i>
            <p>Functies</p>
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
                            <form method="POST" action="{{ route('users.store') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Voornaam</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Voornaam">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Achternaam</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Achternaam">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telefoonnummer</label>
                                            <input type="text" class="form-control" name="tel" id="tel" placeholder="Telefoonnummer">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gsmnummer</label>
                                            <input type="text" class="form-control" name="gsm" id="gsm" placeholder="Gsmnummer">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Paswoord</label>
                                            <input id="password" name="password" type="password" class="form-control" name="Paswoord">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Geboortedatum</label>
                                            <input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="Geboortedatum">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Rijksregister</label>
                                            <input type="text" class="form-control" name="national_register" id="national_register" placeholder="Rijksregister">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contractdatum</label>
                                            <input type="date" class="form-control" name="contract_start_date" id="contract_start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kleur</label>
                                            <input type="text" class="form-control" name="color" id="color" placeholder="Kleur">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Rol</label>
                                            <select class="form-control" name="role_id" id="role_id">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
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