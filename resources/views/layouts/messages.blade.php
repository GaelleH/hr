@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <span><b> Danger - </b> {{$error}}</span>
        </div>
    @endforeach
@endif

@if(session('succes'))
    <div class="alert alert-success">
        <span><b> Success - </b> {{session('succes')}}</span>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <span><b> Danger - </b> {{session('error')}}</span>
    </div>
@endif