@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Teams Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('teams.create') }}"> Create New Team</a>
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
            <th>TeamArea</th>
            <th>Users</th>
            <th>Telephone</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $key => $team)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $team->name }}</td>
                <td>{{ $team->type }}</td>
                <td><ul>
                    @if(count($team->users)==0) no user @endif
                    @foreach($team->users as $user)
                        <li>{{ $user->name }} @if($user->position == 0) (TeamLeader) @endif</li>
                    @endforeach
                </ul></td>
                <td><ul>
                    @foreach($team->users as $user)
                        <li>{{ $user->telephone }}</li>
                    @endforeach
                </ul></td>
                <td>
                    {{--<a class="btn btn-info" href="{{ route('teams.show',$team->id) }}">Show</a>--}}
                    <a class="btn btn-primary" href="{{ route('teams.edit',$team->id) }}">Edit</a> &nbsp;
                    {!! Form::open(['method' => 'DELETE','route' => ['teams.destroy', $team->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'button small primary']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <center>{!! $data->render() !!}</center>

@endsection
