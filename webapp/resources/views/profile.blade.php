<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/4/2020
 * Time: 8:11 PM
 */
?>
@extends('layouts.app')

@section('content')
    <div class="row">
        <h2>Edit User Profile</h2>
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


    @if ($message = Session::get('failed'))
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <p>{{ $message }}</p>
        </div>
    @endif

    @role('admin') <?php $disable = false; ?>
    @else <?php $disable = true; ?>
    @endrole
    {!! Form::model($user, ['method' => 'post','route' => ['home.updateProfile']]) !!}
    {{--<form method="post" action="{{ route('home.updateProfile') }}">--}}
    <div class="row">
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
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple', "disabled"=>$disable)) !!}
            </div>
        </div>
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>Team:</strong>
                {!! Form::select('team_id', $teams, $userTeam, array('class' => 'form-control', "disabled"=>$disable)) !!}
            </div>
        </div>
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>Position:</strong>
                {!! Form::select('position', $positions, $userPosition, array('class' => 'form-control', "disabled"=>$disable)) !!}
            </div>
        </div>

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
        <br/>
        <div class="col-12">
            <br/>
            <input type="submit" class="btn btn-primary" value="Save"/>
        </div>

    </div>
    {!! Form::close() !!}

@endsection

