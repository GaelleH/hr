@extends('layouts.back')

@section('sidebar')
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
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.messages')
            <div class="col-md-6">

                <a href="{{ route('absences.create')}}" class="btn btn-info btn-fill">Nieuw jaar voor gebruiker toevoegen</a>
            </div>
            
            <form action="{{ route('absences.index') }}" method="GET">
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
                            <h4 class="title">Verlofjaren</h4>
                            <p class="category"></p>
                        </div>
                        @if(count($years) > 0)
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Verlofjaar</th>
                                    <th>Gebruiker</th>
                                    <th>Officieel verlof</th>
                                </thead>
                                <tbody>
                                    @foreach($years as $year)
                                    <tr>
                                        <td><a href="absences/{{$year->id}}">{{ $year->id }}</a></td>
                                        <td><a href="absences/{{$year->id}}">{{ $year->year }}</a></td>
                                        @foreach($year->users as $user)
                                            <td><a href="absences/{{$year->id}}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                                        @endforeach
                                        <td><a href="absences/{{$year->id}}">{{ $year->official_leave_hours }}</a></td>
                                    </tr>
                                    @endforeach
                                    {{ $years->appends(['s' => $s])->links() }}
                                </tbody>
                            </table>
                        </div> 
                        @else
                            Geen verlofjaren beschikbaar
                        @endif
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection