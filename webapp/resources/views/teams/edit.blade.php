@extends('layouts.app')

@section('content')
    <div class="row">
        <h2>Edit Team Profile</h2>
        <div style="float: right">
            <a class="btn btn-primary" href="{{ route('teams.index') }}"> Back</a>
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
    {!! Form::model($team, ['method' => 'PATCH','route' => ['teams.update', $team->id]]) !!}
    <div class="row">
        <div class="col-5 col-12-small">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'TeamName','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>Type:</strong>
                {!! Form::select('type', $type, $team->type, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-2 col-6-small">
            <div class="form-group">
                <strong>GPS_X:</strong>
                {!! Form::number('gps_x', null, array('class' => 'form-control', 'pattern' =>"[0-9]+([\.,][0-9]+)?", 'step'=>"0.01")) !!}
            </div>
        </div>

        <div class="col-2 col-6-small">
            <div class="form-group">
                <strong>GPS_Y:</strong>
                {!! Form::number('gps_y', null, array('class' => 'form-control', 'pattern' =>"[0-9]+([\.,][0-9]+)?", 'step'=>"0.01")) !!}
            </div>
        </div>
        <div class="col-12"><br><h4 style="text-align: left">Team Users</h4> </div>
        @foreach($team->users as $user)
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>User{{ $loop->index + 1 }}:</strong>
                {!! Form::select('users[]', $users, $user->id, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-3 col-6-small">
            <div class="form-group">
                <strong>Position:</strong>
                {!! Form::select('positions[]', $positions, $user->position, array('class' => 'form-control')) !!}
            </div>
        </div>
        @endforeach
        <div class="col-12"><br><h4 style="text-align: left">Add Users <span style="font-size: small"> - Please click 'Add User' button to create user form. </span></h4></div>
        <div id="formEndMark"></div>
        <br/>
        <div class="col-12">
            <br/>
            <input type="button" onclick="addUserForm()" value="Add User">
            <input type="submit" class="btn btn-primary" value="Save"/>
        </div>

    </div>
    {!! Form::close() !!}
<script>
    function addUserForm() {
        code = '        <div class="col-3 col-6-small">\n' +
            '            <div class="form-group">\n' +
            '                <strong>New User:</strong>\n' +
            '{!! Form::select("users[]", $users, "", array("class" => "form-control")) !!}' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="col-3 col-6-small">\n' +
            '            <div class="form-group">\n' +
            '                <strong>Position:</strong>\n' +
            '                {!! Form::select("positions[]", $positions, 2, array("class" => "form-control")) !!}\n' +
            '            </div>\n' +
            '        </div><div class="col-6"></div>';
        $('#formEndMark').before(code);
    }
</script>
@endsection
