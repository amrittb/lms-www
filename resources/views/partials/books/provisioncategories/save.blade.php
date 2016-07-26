{{ csrf_field() }}

<div class="row form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
    <label for="category-name" class="col-md-3 control-label">Category Name</label>

    <div class="col-md-6">
        <input id="category-name" type="text" class="form-control" name="category_name" placeholder="Name of the category" value="{{ old('category_name')?:(isset($provisionCategory)?$provisionCategory->category_name:'') }}">

        @if ($errors->has('category_name'))
            <span class="help-block">
                <strong>{{ $errors->first('category_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-primary">
            Save category
        </button>
    </div>
</div>