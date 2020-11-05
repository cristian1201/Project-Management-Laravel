<?php $POSITION = ['Team leader', 'Senior team member', 'Junior team member']; ?>
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered align-left">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>TeamName</th>
            <th>Position</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>@if($user->team) {{ $user->team->name }} @else ____ @endif</td>
                <td>@if($user->position!=null){{ $POSITION[$user->position] }} @else ____ @endif</td>
                <td>
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a> &nbsp;
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'button primary small']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <center>{!! $data->render() !!}</center>

@endsection
