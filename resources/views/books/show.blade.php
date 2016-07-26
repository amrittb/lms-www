@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @include('partials.messagebag')

                <div class="row">
                    <div class="jumbotron">
                        <h2 class="text--center"> {{ $book->book_name }}
                            @can('save-book')
                                <small>
                                    <a href="{{ route('books.edit',['books' => $book->id]) }}">Edit?</a>
                                </small>
                            @endcan
                        </h2>

                        <p>
                            <strong>ISBN: </strong> {{ $book->isbn }}
                        </p>

                        <p>
                            <strong>Edition: </strong> {{ ordinal_suffix(intval($book->edition)) }}
                        </p>
                        <p>
                            <strong>Publication: </strong> {{ $book->publication_name }}
                        </p>
                        <p>
                            <strong>Category: </strong> {{ $book->category_name }}
                        </p>
                        <p>
                            <strong>Authors: </strong>
                            @if(count($book->authors))
                                <ul>
                                    @foreach($book->authors as $author)
                                        <li>
                                            {{  $author->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                No Authors on this book.
                            @endif
                        </p>
                    </div>
                </div>

                @can('save-book-copy')
                    <div class="row">
                        <div class="jumbotron">
                            <h3 class="text--center">Add a book copy</h3>

                            <form action="{{ route('books.copies.store',['books' => $book->id]) }}" method="POST">
                                @include('partials.books.copies.save')
                            </form>
                        </div>
                    </div>
                @endcan

                <h3 class="text--center">Book Copies of '<strong>{{ $book->book_name }}</strong>'</h3><br>

                @if(count($book->copies))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Copy Id</th>
                                    <th>Provider</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book->copies as $copy)
                                    <tr>
                                        <td>{{ $copy->copy_id }}</td>
                                        <td>
                                            {{ $copy->provider_name?:'N/A' }}
                                            <small>
                                                [{{ $copy->provision_category_name?:'N/A' }}]
                                            </small>
                                        </td>
                                        <td>{{ ($copy->is_issued == 0)?"Available":"Issued" }}</td>
                                        <td>
                                            @can('issue-book')
                                                <a href="{{ route('books.copies.createissue',['books' => $book->id,'copies' => $copy->copy_id]) }}" class="btn btn-primary" style="display: inline-block;">Transactions</a>
                                            @endcan

                                            @can('save-book-copy')
                                                <a href="{{ route('books.copies.edit',['books' => $book->id,'copies' => $copy->copy_id]) }}" class="btn btn-warning">Edit</a>
                                            @endcan

                                            @can('delete-book-copy')
                                                <form action="{{ route('books.copies.destroy',['books' => $book->id,'copies' => $copy->copy_id]) }}" method="post" style="display: inline-block;">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="_method" value="delete">

                                                    <input type="submit" value="Delete" class="btn btn-danger">
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <br>
                    <br>
                    <h4 class="text--center">
                        There are no copies for this book. Add at least one.
                    </h4>
                @endif
            </div>
        </div>
    </div>
@endsection
