@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h3 class="text--center">Edit a book entry</h3>
                <br />

                @include('partials.messagebag')

                <br />

                <form action="{{ route('books.update',['books' => $book->id]) }}" method="POST" class="form-horizontal">
                    <input type="hidden" name="_method" value="patch">

                    @include('partials.books.save')
                </form>
            </div>
        </div>
    </div>
@endsection