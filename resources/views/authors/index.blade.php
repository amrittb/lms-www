@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Authors list</h3>

                <form action="{{ route('authors.store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group form-inline">
                        <input type="text" placeholder="Author Name" name="author_name"
                               class="form-control">
                        <input type="submit" value="Add a author" class="btn btn-primary">
                    </div>
                </form>
                
                @include('partials.messagebag')

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
                                        <form action="{{ route('authors.destroy',['authors' => $author->id]) }}" method="POST" style="display: inline-block;">
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
                    There are no authors currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
