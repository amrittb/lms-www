@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h3 class="text--center">Edit a user</h3>
                <br />

                @include('partials.messagebag')

                <br />

                <form action="{{ route('users.update',['users' => $user->id]) }}" method="POST" class="form-horizontal">
                    <input type="hidden" name="_method" value="patch">

                    @include('partials.users.save')

                    <div class="form-group form-inline text--center">
                        <input type="submit" value="Save" class="btn btn-primary form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection