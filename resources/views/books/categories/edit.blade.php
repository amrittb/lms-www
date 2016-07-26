@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Edit a category</h3>

                <br><br>

                @include('partials.messagebag')

                <div class="col-md-10 col-md-offset-1">
                    <form action="{{ route('categories.update',['categories' => $category->id]) }}" method="POST">
                        <input type="hidden" name="_method" value="patch">
                        @include('partials.books.categories.save')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
