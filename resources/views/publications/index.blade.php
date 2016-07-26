@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text--center">Publications</h2>

                <br>

                @include('partials.messagebag')

                @can('save-publication')
                    <div class="row">
                        <div class="jumbotron">
                            <h3 class="text--center">Create a new publication</h3>
                            <br />
                            <form action="{{ route('publications.store') }}" method="POST">
                                @include('partials.publications.save')
                            </form>
                        </div>
                    </div>
                @endcan

                <h3 class="text--center">Publications list</h3>

                @if(count($publications))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Publication name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($publications as $publication)
                                <tr>
                                    <td>{{ $publication->id }}</td>
                                    <td>{{ $publication->publication_name }}</td>
                                    <td>
                                        @can('save-publication')
                                            <a href="{{ route('publications.edit',['publications' => $publication->id]) }}"
                                           class="btn btn-warning">Edit</a>
                                        @endcan

                                        @can('delete-publication')
                                            <form action="{{ route('publications.destroy',['publications' => $publication->id]) }}" method="POST" style="display: inline-block;">
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
                    There are no publications currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
