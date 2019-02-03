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
        <a href="{{ route('absences.index')}}">
            <i class="pe-7s-drawer"></i>
            <p>Verlofjaren</p>
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
@endsection

@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layouts.messages')
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">{{ $function->name}}</h4>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Naam</label>
                                        <div>{{ $function->name }}</div>
                                    </div>
                                </div>
                            </div>
                            @role('management')
                                <a href="{{$function->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                                <form method="POST" action="{{ route('user_functions.destroy', $function->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <button class="btn btn-default btn-fill pull-right">Verwijderen</button>
                                </form>
                            @endrole
                            @role('developer')
                                <a href="{{$function->id}}/edit" class="btn btn-info btn-fill pull-right">Aanpassen</a>
                                <form method="POST" action="{{ route('user_functions.destroy', $function->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <button class="btn btn-default btn-fill pull-right">Verwijderen</button>
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