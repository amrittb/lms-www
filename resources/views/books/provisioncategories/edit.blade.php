@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text--center">Edit a Provision Category</h3>

                <br><br>

                @include('partials.messagebag')

                <div class="col-md-6 col-md-offset-4">
                    <form action="{{ route('provisioncategories.update',['provisioncategories' => $provisionCategory->id]) }}" method="POST">
                        <input type="hidden" name="_method" value="patch">

                        @include('partials.books.provisioncategories.save')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
