{{ csrf_field() }}

<div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="author-name" class="col-md-3 control-label">Author name</label>

    <div class="col-md-6">
        <input id="author-name" type="text" class="form-control" name="name" placeholder="Name of the author" value="{{ old('name')?:(isset($author)?$author->name:'') }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-primary">
            Save author
        </button>
    </div>
</div>