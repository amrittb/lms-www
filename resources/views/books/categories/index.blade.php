@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Book Categories list</h3>

                <form action="{{ route('categories.store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group form-inline">
                        <input type="text" placeholder="Category Name" name="category_name"
                                                   class="form-control">
                        <input type="submit" value="Add a category" class="btn btn-primary">
                    </div>
                </form>

                @include('partials.messagebag')

                @if(count($categories))
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
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <form action="{{ route('categories.destroy',['categories' => $category->id]) }}" method="POST" style="display: inline-block;">
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
                    There are no categories currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
