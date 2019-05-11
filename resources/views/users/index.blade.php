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
    <li class="active">
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
                <a href="{{ route('users.create')}}" class="btn btn-info btn-fill">Nieuwe gebruiker toevoegen</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="content">
                        <div class="row">
                            <form action="{{ route('users.index') }}" method="GET">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input type="text" name="s" class="form-control" value="{{ isset($s) ? $s : '' }}"/>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-default btn-fill" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{url('/user/export')}}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <button class="btn btn-success" type="submit">Export</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="header">
                        <h4 class="title">Gebruikers</h4>
                        <p class="category"></p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Naam</th>
                                <th>Contractdatum</th>
                                <th>Telefoonnr.</th>
                                <th>Email</th>
                                <th>Rol</th>
                            </thead>
                            <tbody>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                <tr>
                                    <td><a href="users/{{$user->id}}">{{ $user->id }}</a></td>
                                    <td><a href="users/{{$user->id}}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                                    <td><a href="users/{{$user->id}}">{{ $user->contract_start_date }}</a></td>
                                    @if(!empty($user->tel))
                                        <td><a href="users/{{$user->id}}">{{ $user->tel }}</a></td>
                                    @else
                                        <td><a href="users/{{$user->id}}">{{ $user->gsm }}</a></td>
                                    @endif
                                    <td><a href="users/{{$user->id}}">{{ $user->email }}</a></td>
                                    @foreach($user->roles as $role)
                                        {{-- @if($user->id == $role->user_id) --}}
                                            <td><a href="users/{{$user->id}}">{{ $role->name }}</a></td>
                                        {{-- @endif --}}
                                    @endforeach
                                </tr>
                                @endforeach
                                {{ $users->appends(['s' => $s])->links() }}
                            @else
                                Geen gebruikers beschikbaar
                            @endif
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection