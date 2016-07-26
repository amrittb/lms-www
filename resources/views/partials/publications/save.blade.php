{{ csrf_field() }}

<div class="row form-group{{ $errors->has('publication_name') ? ' has-error' : '' }}">
    <label for="publication-name" class="col-md-3 control-label">Publication Name</label>

    <div class="col-md-6">
        <input id="publication-name" type="text" class="form-control" name="publication_name" placeholder="Name of the publication" value="{{ old('publication_name')?:(isset($publication)?$publication->publication_name:'') }}">

        @if ($errors->has('publication_name'))
            <span class="help-block">
                <strong>{{ $errors->first('publication_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-primary">
            Save Publication
        </button>
    </div>
</div>