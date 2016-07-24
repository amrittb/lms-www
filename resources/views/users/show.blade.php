@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $user->first_name.' '.$user->middle_name.' '.$user->last_name }} <small><a href="{{ route('users.edit',['users' => $user->id]) }}">Edit?</a></small></h3>

                <br>
                <br>
                <p>
                    <strong>Email: </strong> {{ $user->email }}
                </p>

                <p>
                    <strong>Role: </strong> {{ $user->role_name }}
                </p>
                <p>
                    <strong>Joined At: </strong> {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                </p>
                <p>
                    <strong>Expires At: </strong> {{ \Carbon\Carbon::parse($user->expires_at)->diffForHumans() }}
                </p>
            </div>
        </div>
    </div>
@endsection
