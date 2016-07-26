@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Edit a Book Provider</h3>

                <br><br>

                @include('partials.messagebag')

                <form action="{{ route('providers.update',['providers' => $provider->id]) }}" method="POST">
                    <input type="hidden" name="_method" value="patch">

                    @include('partials.books.providers.save')
                </form>
            </div>
        </div>
    </div>
@endsection
