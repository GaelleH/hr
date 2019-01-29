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
                            <h4 class="title">{{ $user->first_name}} {{ $user->name }}</h4>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Voornaam</label>
                                        <div>{{ $user->first_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Achternaam</label>
                                        <div>{{ $user->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefoonnummer</label>
                                        <div>{{ $user->tel }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gsmnummer</label>
                                        <div>{{ $user->gsm }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div>{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paswoord</label>
                                        <div>*************</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Geboortedatum</label>
                                        <div>{{ $user->birth_date }}</div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Rijksregister</label>
                                        <div>{{ $user->national_register }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contractdatum</label>
                                        <div>{{ $user->contract_start_date }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kleur</label>
                                        <div>{{ $user->color }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rol</label>
                                        @foreach($user->roles as $role)
                                            <div>{{ $role->name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @role('management')
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <button class="btn btn-default btn-fill pull-right">Verwijderen</button>
                                </form>
                            @endrole
                            @role('developer')
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <button class="btn btn-default btn-fill pull-right">Verwijderen</button>
                                </form>
                            @endrole
                            @if(auth::user()->id == $user->id)
                                <a href="{{$user->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                            @else
                                @role('developer')
                                    <a href="{{$user->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                                @endrole
                                @role('management')
                                    <a href="{{$user->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                                @endrole
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection