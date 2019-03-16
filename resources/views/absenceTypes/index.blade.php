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
    <li class="active">
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
    <li>
        <a href="{{ route('absences.index')}}">
            <i class="pe-7s-drawer"></i>
            <p>Verlofjaren</p>
        </a>
    </li>
    <li class="active">
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
    <li class="active">
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
            <div class="col-md-4">
                @role('developer')
                    <a href="{{ route('absence-types.create')}}" class="btn btn-info btn-fill">Nieuw afwezigheidstype toevoegen</a>
                @endrole
            </div>
            
            <form action="{{ route('absence-types.index') }}" method="GET">
                <div class="form-group">
                    <div class="col-md-4">
                        <input type="text" name="s" class="form-control" value="{{ isset($s) ? $s : '' }}"/>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-default btn-fill" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="col-md-2">
                <form action="{{url('/absence-type/export')}}" enctype="multipart/form-data">
                    <button class="btn btn-success" type="submit">Export</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="header">
                        <h4 class="title">Afwezigheidstypes</h4>
                        <p class="category"></p>
                    </div>
                    @if(count($types) > 0)
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Naam</th>
                            </thead>
                            <tbody>
                                @foreach($types as $type)
                                <tr>
                                    <td><a href="absence-types/{{$type->id}}">{{ $type->id }}</a></td>
                                    <td><a href="absence-types/{{$type->id}}">{{ $type->name }}</a></td>
                                </tr>
                                @endforeach
                                {{ $types->appends(['s' => $s])->links() }}
                            </tbody>
                        </table>
                    </div> 
                    @else
                        Geen afwezigheidstypes beschikbaar
                    @endif
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection