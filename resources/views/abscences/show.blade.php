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
    <li class="active">
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
    <li>
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
    <li class="active">
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
    <li>
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
@endsection

@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layouts.messages')
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">{{ $year->year}}</h4>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Verlofjaar</label>
                                        <div>{{ $year->year }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Officiële verlofuren</label>
                                        <div>{{ $year->official_leave_hours }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gebruiker</label>
                                        @foreach($year->users as $user)
                                            <div>{{ $user->first_name }} {{$user->last_name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @role('management')
                                <form method="POST" action="{{ route('absences.destroy', $year->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <button class="btn btn-default btn-fill pull-right">Verwijderen</button>
                                </form>
                            @endrole
                            @role('developer')
                                <form method="POST" action="{{ route('absences.destroy', $year->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <button class="btn btn-default btn-fill pull-right">Verwijderen</button>
                                </form>
                            @endrole
                            @role('developer')
                                <a href="{{$year->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                            @endrole
                            @role('management')
                                <a href="{{$year->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                            @endrole
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection