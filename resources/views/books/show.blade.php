@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $book->book_name }} <small><a href="{{ route('books.edit',['books' => $book->id]) }}">Edit?</a></small></h3>

                <p>
                    <strong>ISBN: </strong> {{ $book->isbn }}
                </p>

                <p>
                    <strong>Edition: </strong> {{ $book->edition }}
                </p>
                <p>
                    <strong>Publication: </strong> {{ $book->publication_name }}
                </p>

                <strong>Copies: </strong> <br />

                <a href="#" class="btn btn-primary">Add Another Copy</a>

                <div class="table-responsive">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Copy Id</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($book->copies as $copy)
                                <tr>
                                    <td>{{ $copy->copy_id }}</td>
                                    <td>Status</td>
                                    <td>Actions</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
