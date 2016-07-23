@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Book list</h3>

                @include('partials.messagebag')

                @if(count($books))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Isbn</th>
                                    <th>Edition</th>
                                    <th>Publication</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->book_name }}</td>
                                        <td>{{ $book->isbn }}</td>
                                        <td>{{ $book->edition }} Edition</td>
                                        <td>{{ $book->publication_name }}</td>
                                        <td>
                                            <a href="{{ route('books.edit',['books' => $book->id]) }}" class="btn btn-primary">Edit?</a>
                                            <form action="{{ route('books.destroy',['books' => $book->id]) }}" method="POST" style="display: inline-block;">
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
                    There are no books currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
