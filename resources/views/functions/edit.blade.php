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
                        <h4 class="title">Functie aanpassen</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('user_functions.update', $function) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT')}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Achternaam</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Achternaam" value="{{ $function->name }}">
                                    </div>
                                </div>
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