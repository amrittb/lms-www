@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Edit a book copy</h3>

                <br><br>

                @include('partials.messagebag')

                <div class="col-md-10 col-md-offset-1">
                    <form action="{{ route('books.copies.update',['books' => $bookCopy->book_id,'copies' => $bookCopy->copy_id]) }}" method="POST">
                        <input type="hidden" name="_method" value="patch">

                        @include('partials.books.copies.save')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
