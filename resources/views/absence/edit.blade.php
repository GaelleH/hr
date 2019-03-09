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
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Afwezigheid aanpassen</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('absence.update', $absence) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT')}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Medewerker</label>
                                        <select class="form-control" name="user_id" id="user_id">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" @if ($absence->user_id == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                    @role('employee')
                                    <div class="form-group">
                                        <label>Verlofjaar</label>
                                        @foreach($years->users as $u)
                                            <select class="form-control" name="absences_year_id" id="absences_year_id">
                                                <option value="{{ $years->id }}" @if ($absence->absences_year_id == $years->id) selected @endif>{{ $years->year }} - {{ $u->first_name}} {{ $u->last_name }}</option>
                                            </select>
                                        @endforeach
                                    </div>
                                    @endrole
                                    @role('management')
                                    <div class="form-group">
                                        <label>Verlofjaar</label>
                                        <select class="form-control" name="absences_year_id" id="absences_year_id">
                                            @foreach($allYears as $allYear)
                                                <option value="{{ $allYear->id }}" @if ($absence->absences_year_id == $allYear->id) selected @endif>{{ $allYear->year }} - {{ $allYear->first_name}} {{ $allYear->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endrole
                                    @role('developer')
                                    <div class="form-group">
                                        <label>Verlofjaar</label>
                                        <select class="form-control" name="absences_year_id" id="absences_year_id">
                                            @foreach($allYears as $allYear)
                                                <option value="{{ $allYear->id }}" @if ($absence->absences_year_id == $allYear->id) selected @endif>{{ $allYear->year }} - {{ $allYear->first_name}} {{ $allYear->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endrole
                                    <div class="form-group">
                                        <label>Afwezigheidstype</label>
                                        <select class="form-control" name="absence_type_id" id="absence_type_id">
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}" @if ($absence->absence_type_id == $type->id) selected @endif>{{ $type->name }}</option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Opmerkingen</label>
                                        <textarea rows="9" class="form-control" name="remarks" id="remarks">{{ $absence->remarks }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">  
                                <table class="table" id="dynamic_field">  
                                    <?php $count = 0; ?>
                                    @if (!empty($items))
                                        @foreach ($dates as $date)
                                        <tr>  
                                            <td><input type="date" name="rows[<?= $count ?>][date]" class="form-control date_list" value="{{ $date->date }}" /></td>  
                                            <td><input type="number" name="rows[<?= $count ?>][number_of_hours]" placeholder="Aantal uur" class="form-control date_list" value="{{ $date->number_of_hours }}" /></td>  
                                            <td><button type="button" name="remove" id="remove" class="btn btn-danger btn_remove"><i class="pe-7s-close-circle"></i></button></td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success"><i class="pe-7s-plus"></i></button></td>  
                                        </tr> 
                                        @endforeach 
                                    @else
                                        <tr>  
                                            <td><input type="date" name="rows[<?= $count ?>][date]" class="form-control date_list" /></td>  
                                            <td><input type="number" name="rows[<?= $count ?>][number_of_hours]" placeholder="Aantal uur" class="form-control date_list" /></td>  
                                            <td><button type="button" name="remove" id="remove" class="btn btn-danger btn_remove"><i class="pe-7s-close-circle"></i></button></td>
                                            <td><button type="button" name="add" id="add" class="btn btn-success"><i class="pe-7s-plus"></i></button></td>  
                                        </tr>
                                    @endif
                                    <?php $count++; ?>
                                </table>  
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){      
        var postURL = "<?php echo url('addmore'); ?>";
        var i = <?= $count; ?>;
        console.log(i);  


        $('#add').click(function(){  
            $('#dynamic_field').append('<tr id="row'+ i +'" class="dynamic-added"><td><input type="date" name="rows[' + i +'][date]" class="form-control date_list" /></td><td><input type="number" name="rows[' + i +'][number_of_hours]" placeholder="Aantal uur" class="form-control date_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="pe-7s-close-circle"></i></button></td></tr>');  
        });

        $('#remove').click(function(){  
            $(this).closest("tr").remove();  
        });  


        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+ button_id +'').remove();  
        });  
    });  
</script>
@endsection