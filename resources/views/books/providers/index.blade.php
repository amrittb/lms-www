@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text--center">Book Providers</h2>

                <br><br>

                @include('partials.messagebag')

                <div class="row">
                    <div class="jumbotron">
                        <h3 class="text--center">Create a book provider</h3><br>

                        <form action="{{ route('providers.store') }}" method="POST">
                            @include('partials.books.providers.save')
                        </form>
                    </div>
                </div>

            <h3 class="text--center">Book Providers list</h3>

            @if(count($bookProviders))
                    <div class="table-responsive">
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Provider Name</th>
                                <th>Contact No</th>
                                <th>Contact Person Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookProviders as $provider)
                                <tr>
                                    <td>{{ $provider->id }}</td>
                                    <td>{{ $provider->provider_name }}</td>
                                    <td>{{ $provider->contact_no }}</td>
                                    <td>{{ $provider->contact_pname }}</td>
                                    <td>
                                        <a href="{{ route('providers.edit',['providers' => $provider->id]) }}"
                                           class="btn btn-warning">Edit</a>
                                        <form action="{{ route('providers.destroy',['providers' => $provider->id]) }}" method="POST" style="display: inline-block;">
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
                    There are no book providers currently.
                </h4>
            @endif
        </div>
    </div>
@endsection
