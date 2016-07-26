@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text--center">Book Categories</h2><br>

                @include('partials.messagebag')

                @can('save-book-category')
                    <div class="row">
                        <div class="jumbotron">
                            <h3 class="text--center">Create a new category</h3><br>
                            <form action="{{ route('categories.store') }}" method="POST">
                                @include('partials.books.categories.save')
                            </form>
                        </div>
                    </div>
                @endcan

                <h3 class="text--center">Book Categories List</h3>

                @if(count($categories))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        @can('save-book-category')
                                            <a href="{{ route('categories.edit',['categories' => $category->id]) }}" class="btn btn-warning">Edit</a>
                                        @endcan

                                        @can('delete-book-category')
                                            <form action="{{ route('categories.destroy',['categories' => $category->id]) }}" method="POST" style="display: inline-block;">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="_method" value="delete">

                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            @else
                <h4 class="text--center">
                    There are no categories currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
