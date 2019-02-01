@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="col-md-6">
        <div class="alert test-alert-danger">
            <button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
            <span>{{$error}}</span>
        </div>
        {{-- <div class="alert alert-danger">
            <button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
            <span><b> Danger - </b> {{$error}}</span>
        </div> --}}
    </div>
    @endforeach
@endif

@if(session('succes'))
    <div class="alert test-alert-success">
        <span><b> Success - </b> {{session('succes')}}</span>
    </div>
@endif

@if(session('error'))
    <div class="alert test-alert-danger">
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
        <span><b> Opgelet! - </b> {{session('error')}}</span>
    </div>
@endif