<?php $POSITION = ['Team leader', 'Senior team member', 'Junior team member']; ?>
@extends('layouts.app')

@section('content')
    <div class="row">
        <h2> Show User</h2>
        <div class="align-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>

    <div class="row align-left" style="">
        <ul>
            <li><strong>Name:</strong>
                {{ $user->name }}
            </li>
            <li><strong>LastName:</strong>
                {{ $user->lastname }}
            </li>
            <li><strong>Telephone:</strong>
                {{ $user->telephone }}
            </li><br/>

            <li><strong>Team Name:</strong>
                @if($user->team) {{ $user->team->name }} @else no team @endif
            </li>
            <li>
                <strong>Team Position:</strong>
                @if($user->position!=null){{ $POSITION[$user->position] }} @else no position @endif
            </li><br/>

            <li>
                <strong>Roles:</strong>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        {{ $v }}
                        @if(!$loop->last) / @endif
                    @endforeach
                @else None
                @endif
                {{--@if(!empty($user->getRoleNames())) {{ implode("/", $user->getRoleNames()) }} @else None @endif--}}
            </li><br/>

            <li><strong>Email:</strong>
                {{ $user->email }}
            </li>
        </ul>
    </div>
@endsection
