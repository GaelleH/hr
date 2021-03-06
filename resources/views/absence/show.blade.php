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
@endrole
@role('management')
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
    <li>
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
                @if($absence)
                    @if($absence->status == 2)
                        <div class="alert test-alert-success">
                            <span><b><i class="pe-7s-smile"></i></b>  De aanvraag werd goedgekeurd</span>
                        </div>
                    @endif
                    @if($absence->status == 3)
                        <div class="alert test-alert-danger">
                            <span><b><i class="pe-7s-bell"></i></b>  De aanvraag werd afgekeurd</span>
                        </div>
                    @endif
                @endif
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
                        @if(Auth::user()->id == $absence->user_id && $absence->status < 2)
                            <form method="POST" action="{{ route('absence.destroy', $absence->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-default btn-fill pull-right">Verwijderen</button>
                            </form>
                            <a href="{{$absence->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection