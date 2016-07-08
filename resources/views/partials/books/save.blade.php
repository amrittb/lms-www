{{ csrf_field() }}

<div class="form-group{{ $errors->has('book_name') ? ' has-error' : '' }}">
    <label for="book-name" class="col-md-4 control-label">Book Name</label>

    <div class="col-md-6">
        <input id="book-name" type="text" class="form-control" name="book_name" value="{{ old('book_name') }}">

        @if ($errors->has('book_name'))
            <span class="help-block">
                <strong>{{ $errors->first('book_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('isbn') ? ' has-error' : '' }}">
    <label for="isbn" class="col-md-4 control-label">ISBN No.</label>

    <div class="col-md-6">
        <input id="isbn" type="text" class="form-control" name="isbn" value="{{ old('isbn') }}">

        @if ($errors->has('isbn'))
            <span class="help-block">
                <strong>{{ $errors->first('isbn') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('edition') ? ' has-error' : '' }}">
    <label for="edition" class="col-md-4 control-label">Edition</label>

    <div class="col-md-6">
        <input id="edition" type="number" class="form-control" name="edition" value="{{ old('edition') }}">

        @if ($errors->has('edition'))
            <span class="help-block">
                <strong>{{ $errors->first('edition') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('publication_id') ? ' has-error' : '' }}">
    <label for="publication-id" class="col-md-4 control-label">Publication</label>

    <div class="col-md-6">
        <select id="publication-id" class="form-control" name="publication_id">
            @foreach($publications as $publication)
                <option value="{{ $publication->id }}">{{ $publication->publication_name }}</option>
            @endforeach
        </select>

        @if ($errors->has('publication_id'))
            <span class="help-block">
                <strong>{{ $errors->first('publication_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Save Book
        </button>
    </div>
</div>