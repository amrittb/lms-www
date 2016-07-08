@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h3 class="text--center">Create a new Book Entry</h3>
                <br />

                <form action="{{ route('books.store') }}" method="POST" class="form-horizontal">
                    @include('partials.books.save')
                </form>
            </div>
        </div>
    </div>
@endsection