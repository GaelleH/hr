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
                            <h4 class="title">Nieuwe afwezigheid</h4>
                        </div>
                        <div class="content">
                            <form method="POST" action="{{ route('absence.store') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Medewerker</label>
                                            <select class="form-control" name="user_id" id="user_id">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @role('employee')
                                        <div class="form-group">
                                            <label>Verlofjaar</label>
                                            @foreach($years->users as $u)
                                                <select class="form-control" name="absences_year_id" id="absences_year_id">
                                                    <option value="{{ $years->id }}">{{ $years->year }} - {{ $u->first_name}} {{ $u->last_name }}</option>
                                                </select>
                                            @endforeach
                                        </div>
                                        @endrole
                                        @role('management')
                                        <div class="form-group">
                                            <label>Verlofjaar</label>
                                            <select class="form-control" name="absences_year_id" id="absences_year_id">
                                                @foreach($allYears as $allYear)
                                                    <option value="{{ $allYear->id }}">{{ $allYear->year }} - {{ $allYear->first_name}} {{ $allYear->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endrole
                                        @role('developer')
                                        <div class="form-group">
                                            <label>Verlofjaar</label>
                                            <select class="form-control" name="absences_year_id" id="absences_year_id">
                                                @foreach($allYears as $allYear)
                                                    <option value="{{ $allYear->id }}">{{ $allYear->year }} - {{ $allYear->first_name}} {{ $allYear->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endrole
                                        <div class="form-group">
                                            <label>Afwezigheidstype</label>
                                            <select class="form-control" name="absence_type_id" id="absence_type_id">
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Opmerkingen</label>
                                            <textarea rows="9" class="form-control" name="remarks" id="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                    
                                <div class="alert alert-success print-success-msg" style="display:none">
                                <ul></ul>
                                </div>
                    
                    
                                <div class="table-responsive">  
                                    <table class="table" id="dynamic_field">  
                                        <?php $count = 0; ?>
                                        <tr>  
                                            <td><input type="date" name="rows[<?= $count ?>][date]" class="form-control date_list" /></td>  
                                            <td><input type="number" name="rows[<?= $count ?>][number_of_hours]" placeholder="Aantal uur" class="form-control date_list" /></td>  
                                            <td><button type="button" name="add" id="add" class="btn btn-success"><i class="pe-7s-plus"></i></button></td>  
                                        </tr>  
                                        <?php $count++; ?>
                                    </table>  
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Opslaan</button>
                                </div>
                            
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
    
    
          $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row'+ button_id +'').remove();  
          });  
    
    
        //   $.ajaxSetup({
        //       headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //       }
        //   });
    
    
        //   $('#submit').click(function(){            
        //        $.ajax({  
        //             url:postURL,  
        //             method:"POST",  
        //             data:$('#add_name').serialize(),
        //             type:'json',
        //             success:function(data)  
        //             {
        //                 if(data.error){
        //                     printErrorMsg(data.error);
        //                 }else{
        //                     i=1;
        //                     $('.dynamic-added').remove();
        //                     $('#add_name')[0].reset();
        //                     $(".print-success-msg").find("ul").html('');
        //                     $(".print-success-msg").css('display','block');
        //                     $(".print-error-msg").css('display','none');
        //                     $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
        //                 }
        //             }  
        //        });  
        //   });  
    
    
        //   function printErrorMsg (msg) {
        //      $(".print-error-msg").find("ul").html('');
        //      $(".print-error-msg").css('display','block');
        //      $(".print-success-msg").css('display','none');
        //      $.each( msg, function( key, value ) {
        //         $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        //      });
        //   }
        });  
    </script>
@endsection