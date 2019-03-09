@extends('layouts.back')

@section('sidebar')
<ul class="nav">
    <li class="active">
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
            <div class="col-md-12">
                <div class="alert test-alert-success" style="text-align:center">
                    <i class="pe-7s-hourglass"></i>
                    <span>Overige inzetbare verlofuren dit jaar <b>{{ $remaining->official_leave_hours_remaining }}</b></span>
                </div>
            </div>
        </div>
        <div class="row">
            @role('developer')
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Aanvragen</h4>
                        <p class="category">Alle openstaande verlofaanvragen</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    @foreach ($absence as $a)
                                    <tr>
                                        <td><a href="unapproved-absence/{{$a->id}}">{{ $a->first_name}} {{$a->last_name}} - {{$a->name}}</a></td>
                                        <td class="td-actions text-right">
                                            <a href="unapproved-absence/{{$a->id}}" type="button" rel="tooltip" title="Aanvraag aanpassen" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                @if(count($absence) > 4)
                                    <a href="{{ route('unapprovedAbsences') }}"><i class="fa fa-angle-right"></i> Alle open aanvragen bekijken</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('management')
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Aanvragen</h4>
                        <p class="category">Alle openstaande verlofaanvragen</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    @foreach ($absence as $a)
                                    <tr>
                                        <td><a href="unapproved-absence/{{$a->id}}">{{ $a->first_name}} {{$a->last_name}} - {{$a->name}}</a></td>
                                        <td class="td-actions text-right">
                                            <a href="unapproved-absence/{{$a->id}}" type="button" rel="tooltip" title="Aanvraag aanpassen" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                @if(count($absence) > 4)
                                    <a href="{{ route('unapprovedAbsences') }}"><i class="fa fa-angle-right"></i> Alle open aanvragen bekijken</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('employee')
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Aanvragen</h4>
                        <p class="category">Alle goedgekeurde verlofaanvragen</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    @foreach ($myAbsence as $a)
                                    <tr>
                                        <td><a href="absence/{{$a->id}}">{{ $a->first_name}} {{$a->last_name}} - {{$a->name}}</a></td>
                                        <td class="td-actions text-right">
                                            <a href="absence/{{$a->id}}" type="button" rel="tooltip" title="Aanvraag bekijken" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                @if(count($absence) > 4)
                                    <a href="{{ route('myAbsence') }}"><i class="fa fa-angle-right"></i> Alle aanvragen bekijken</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Verlof</h4>
                        <p class="category">Afwezigen deze week</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    @foreach ($dates as $d)
                                    <tr>
                                        <td>{{ date('d-m', strtotime($d->date)) }}</td> 
                                        <td>{{ $d->first_name}} {{$d->last_name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Verjaardag</h4>
                        <p class="category">Verjaardagen deze maand</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ date('d-m', strtotime($user->birth_date)) }}</td> 
                                        <td>{{ $user->first_name}} {{$user->last_name}}</td>
                                    </tr>
                                    @endforeach
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