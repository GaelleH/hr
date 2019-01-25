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
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Paswoord aanpassen</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('changePassword') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Huidig paswoord</label>
    
                                    <div class="col-md-6">
                                        <input id="current-password" type="password" class="form-control" name="current-password" required>
    
                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Nieuw paswoord</label>
    
                                    <div class="col-md-6">
                                        <input id="new-password" type="password" class="form-control" name="new-password" required>
    
                                        @if ($errors->has('new-password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Confirmeer nieuw paswoord</label>
    
                                    <div class="col-md-6">
                                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-info btn-fill">
                                            Verander paswoord
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection