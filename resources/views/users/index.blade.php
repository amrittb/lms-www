@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Users list</h3>

                @include('partials.messagebag')

                @if(count($users))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Expiry Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name.' '.$user->middle_name.' '.$user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->expires_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('users.show',['users' => $user->id]) }}" class="btn btn-primary">View User</a>
                                        <a href="{{ route('users.edit',['users' => $user->id]) }}" class="btn btn-warning">Edit?</a>
                                        <form action="{{ route('users.destroy',['users' => $user->id]) }}" method="POST" style="display: inline-block;">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="_method" value="delete">

                                            <input type="submit" class="btn btn-danger" value="Delete?">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            @else
                <h4 class="text--center">
                    There are no users currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
