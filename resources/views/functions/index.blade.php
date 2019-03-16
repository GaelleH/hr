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
    <li class="active">
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
    <li class="active">
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
            <div class="col-md-8">
                <a href="{{ route('user_functions.create')}}" class="btn btn-info btn-fill">Nieuwe functie toevoegen</a>
            </div>
            <div class="col-md-2">
                <form action="{{url('/user-function/export')}}" enctype="multipart/form-data">
                    <button class="btn btn-success" type="submit">Export</button>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="header">
                            <h4 class="title">Functies</h4>
                            <p class="category"></p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Naam</th>
                                </thead>
                                <tbody>
                                @if(count($functions) > 0)
                                    @foreach($functions as $function)
                                    <tr>
                                        <td><a href="user_functions/{{$function->id}}">{{ $function->id }}</a></td>
                                        <td><a href="user_functions/{{$function->id}}">{{ $function->name }}</a></td>
                                    </tr>
                                    @endforeach
                                    {{ $functions->links() }}
                                @else
                                    Geen functies beschikbaar
                                @endif
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection