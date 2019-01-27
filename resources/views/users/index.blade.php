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
</ul>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @include('layouts.messages')
            <a href="{{ route('users.create')}}" class="btn btn-info btn-fill">Nieuwe gebruiker toevoegen</a>
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
                                        <td><a href="users/{{$user->id}}">{{ $user->first_name }} {{ $user->name }}</a></td>
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
                                    {{ $users->links() }}
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
</div>
@endsection