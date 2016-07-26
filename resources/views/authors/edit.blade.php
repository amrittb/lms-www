@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Edit an author</h3>

                <br><br>

                @include('partials.messagebag')

                <div class="col-md-10 col-md-offset-1">
                    <form action="{{ route('authors.update',['authors' => $author->id]) }}" method="POST">
                        <input type="hidden" name="_method" value="patch">

                        @include('partials.authors.save')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
