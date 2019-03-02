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
        <a href="{{ route('absence.index')}}">
            <i class="pe-7s-sun"></i>
            <p>Afwezigheden</p>
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
@endsection

@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layouts.messages')
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Afwezigheid aanpassen</h4>
                        </div>
                        <div class="content">
                            <form method="POST" action="{{ route('absence.update', $absence) }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT')}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Medewerker</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if ($absence->user_id == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                        <div class="form-group">
                                            <label>Verlofjaar</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}" @if ($absence->absences_year_id == $year->id) selected @endif>{{ $year->year }}</option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                        <div class="form-group">
                                            <label>Afwezigheidstype</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}" @if ($absence->absence_type_id == $type->id) selected @endif>{{ $type->name }}</option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Opmerkingen</label>
                                            <textarea rows="9" class="form-control" name="remarks" id="remarks">{{ $absence->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Extra verlofuren</label>
                                                <input type="number" class="form-control" name="extra_leave_hours" id="extra_leave_hours" value="{{ $year->extra_leave_hours }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gebruiker</label>
                                                <select class="form-control" name="user_id" id="user_id">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" @if ($year->user_id == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
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