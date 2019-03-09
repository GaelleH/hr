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
            <div class="col-md-6">

                <a href="{{ route('absence.create')}}" class="btn btn-info btn-fill">Nieuwe aanvraag toevoegen</a>
            </div>
            
            <form action="{{ route('absence.index') }}" method="GET">
                <div class="form-group">
                <div class="col-md-4">
                    <input type="text" name="s" class="form-control" value="{{ isset($s) ? $s : '' }}"/>
                </div>
                <div class="col-md-2">

                    <button class="btn btn-default btn-fill" type="submit">Search</button>
                </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="header">
                        <h4 class="title">Afwezigheden</h4>
                        <p class="category"></p>
                    </div>
                    @if(count($absences) > 0)
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Datum</th>
                                <th>Verlofjaar</th>
                                <th>Gebruiker</th>
                                <th>Afwezigheidstype</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach($absences as $absence)
                                <tr>
                                    <td><a href="absence/{{$absence->id}}">{{ $absence->id }}</a></td>
                                    <td><a href="absence/{{$absence->id}}">{{ $test[$absence->id] }}</a></td>
                                    <td><a href="absence/{{$absence->id}}">{{ $absence->year }}</a></td>
                                    <td><a href="absence/{{$absence->id}}">{{ $absence->first_name }} {{ $absence->last_name }}</a></td>
                                    <td><a href="absence/{{$absence->id}}">{{ $absence->name }}</a></td>
                                    @if ($absence->status == '1')
                                        <td><a href="absence/{{$absence->id}}">Nieuw</a></td>
                                    @elseif ($absence->status == '2')
                                        <td><a href="absence/{{$absence->id}}">Goedgekeurd</a></td>
                                    @else
                                        <td><a href="absence/{{$absence->id}}">Afgekeurd</a></td>
                                    @endif
                                </tr>
                                @endforeach
                                {{ $absences->appends(['s' => $s])->links() }}
                            </tbody>
                        </table>
                    </div> 
                    @else
                        Geen afwezigheden beschikbaar
                    @endif
                </div>
            </div>
        </div> 
            
    </div>
</div>
@endsection