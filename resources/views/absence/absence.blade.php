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
                        <h4 class="title">{{ $absence->name }} {{ $absence->first_name }}</h4>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Medewerker</label>
                                    <div>{{ $absence->first_name }} {{ $absence->last_name }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Verlofjaar</label>
                                    <div>{{ $absence->year }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Afwezigheidstype</label>
                                    <div>{{ $absence->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Opmerkingen</label>
                                    <div>{{ $absence->remarks }}</div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">  
                            <table class="table">  
                                <thead>
                                    <th>Datum</th>
                                    <th>Aantal uren</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($dates as $date) : ?>
                                        <tr>  
                                            <td>{{ $date->date }}</td>  
                                            <td>{{ $date->number_of_hours }}</td>  
                                        </tr>  
                                    <?php endforeach; ?>
                                </tbody>
                            </table>  
                        </div>
                        @role('developer')
                            <form method="POST" action="{{ route('notApproved', $absence->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                <button class="btn btn-danger btn-fill pull-right">Afkeuren</button>
                            </form>
                        @endrole
                        @role('developer')
                            <form method="POST" action="{{ route('approve', $absence->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <button class="btn btn-success btn-fill pull-right">Goedkeuren</button>
                            </form>       
                        @endrole
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection