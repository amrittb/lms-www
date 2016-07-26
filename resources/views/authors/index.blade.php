@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text--center">Authors</h2>

                @include('partials.messagebag')

                <div class="row">
                    <div class="jumbotron">
                        <h3 class="text--center">Create a new author</h3><br>
                        <form action="{{ route('authors.store') }}" method="POST">
                            @include('partials.authors.save')
                        </form>
                    </div>
                </div>

                <h3 class="text--center">Authors List</h3>

                @if(count($authors))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td>{{ $author->id }}</td>
                                    <td>{{ $author->name }}</td>
                                    <td>
                                        <a href="{{ route('authors.edit',['authors' => $author->id]) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('authors.destroy',['authors' => $author->id]) }}" method="POST" style="display: inline-block;">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="_method" value="delete">

                                            <input type="submit" class="btn btn-danger" value="Delete">
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
                    There are no authors currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
