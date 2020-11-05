@extends('layouts.app')

@section('content')
    <div class="row">
        <h2>Add New User</h2>
        <div style="float: right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-3 col-5-small">
            <div class="form-group">
                <strong>LastName:</strong>
                {!! Form::text('lastname', null, array('placeholder' => 'LastName','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-6 col-12-small">
            <div class="form-group">
                <strong>Username:</strong>
                {!! Form::text('username', null, array('placeholder' => 'username','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-6 col-12-small">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-6 col-12-small">
            <div class="form-group">
                <strong>Telephone:</strong>
                {!! Form::text('telephone', null, array('placeholder' => 'Telephone','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-6 col-12-small">
            <div class="form-group">
                <strong>Password:</strong>
                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-6 col-12-small">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-6 col-12-small">
            <div class="form-group">
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>Team:</strong>
                {!! Form::select('team_id', $teams, null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>Position:</strong>
                {!! Form::select('position', $positions, null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <br/>
        <div class="col-12">
            <br/>
            <input type="submit" class="button primary" value="Save"/>
        </div>

    </div>
    {!! Form::close() !!}

@endsection
