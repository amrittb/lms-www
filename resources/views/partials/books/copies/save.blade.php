<h3 class="text--center">Add a book copy</h3>

<form action="{{ route('books.copies.store',['books' => $book->id]) }}" method="POST">
    {{ csrf_field() }}

    <div class="row form-group{{ $errors->has('copy_id') ? ' has-error' : '' }}">
        <label for="copy-id" class="col-md-4 control-label">Copy Id</label>

        <div class="col-md-6">
            <input id="copy-id" type="number" placeholder="Copy Id for this copy" class="form-control" name="copy_id" value="{{ old('copy_id') }}">

            @if ($errors->has('copy_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('copy_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('provider_id') ? ' has-error' : '' }}">
        <label for="provider-id" class="col-md-4 control-label">Book Provider</label>

        <div class="col-md-6">
            <select id="provider-id" class="form-control chosen-select" name="provider_id">
                @foreach($bookProviders as $provider)
                    <option value="{{ $provider->id }}"
                            {{ (intval(old('provider_id')) == $provider->id)?'selected':'' }}
                    >
                        {{ $provider->provider_name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('provider_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('provider_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row form-group{{ $errors->has('provision_category_id') ? ' has-error' : '' }}">
        <label for="provision-category-id" class="col-md-4 control-label">Provision Category</label>

        <div class="col-md-6">
            <select id="provision-category-id" class="form-control chosen-select" name="provision_category_id">
                @foreach($provisionCategories as $category)
                    <option value="{{ $category->id }}"
                            {{ (intval(old('provision_category_id')) == $category->id)?'selected':'' }}
                    >
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('provision_category_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('provision_category_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Add a Copy
            </button>
        </div>
    </div>
</form>