{{ csrf_field() }}

<div class="form-group{{ $errors->has('book_name') ? ' has-error' : '' }}">
    <label for="book-name" class="col-md-3 control-label">Book Name</label>

    <div class="col-md-6">
        <input id="book-name" type="text" class="form-control" name="book_name" placeholder="Title of the book" value="{{ old('book_name')?:(isset($book)?$book->book_name:'') }}">

        @if ($errors->has('book_name'))
            <span class="help-block">
                <strong>{{ $errors->first('book_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('isbn') ? ' has-error' : '' }}">
    <label for="isbn" class="col-md-3 control-label">ISBN No.</label>

    <div class="col-md-6">
        <input id="isbn" type="text" class="form-control" name="isbn" placeholder="ISBN of the book edition" value="{{ old('isbn')?:(isset($book)?$book->isbn:'') }}">

        @if ($errors->has('isbn'))
            <span class="help-block">
                <strong>{{ $errors->first('isbn') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('edition') ? ' has-error' : '' }}">
    <label for="edition" class="col-md-3 control-label">Edition</label>

    <div class="col-md-6">
        <input id="edition" type="number" class="form-control" name="edition" placeholder="Edition of the book" value="{{ old('edition')?:(isset($book)?$book->edition:'') }}">

        @if ($errors->has('edition'))
            <span class="help-block">
                <strong>{{ $errors->first('edition') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('publication_id') ? ' has-error' : '' }}">
    <label for="publication-id" class="col-md-3 control-label">Publication</label>

    <div class="col-md-6">
        <select id="publication-id" class="form-control chosen-select" name="publication_id">
            @foreach($publications as $publication)
                <option value="{{ $publication->id }}"
                    {{ (intval(old('publication_id')?:(isset($book)?$book->publication_id:$publications->first()->id)) == $publication->id)?'selected':'' }}
                >
                    {{ $publication->publication_name }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('publication_id'))
            <span class="help-block">
                <strong>{{ $errors->first('publication_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-3">
        <a href="{{ route('publications.index') }}" target="_blank" class="btn btn-primary btn-block">Add new publication</a>
    </div>
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label for="category-id" class="col-md-3 control-label">Category</label>

    <div class="col-md-6">
        <select id="category-id" class="form-control chosen-select" name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        {{ (intval(old('category_id')?:(isset($book)?$book->category_id:$categories->first()->id)) == $category->id)?'selected':'' }}
                >
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-3">
        <a href="{{ route('categories.index') }}" target="_blank" class="btn btn-primary btn-block">Add new book category</a>
    </div>
</div>

<div class="form-group{{ $errors->has('author_ids') ? ' has-error' : '' }}">
    <label for="author-ids" class="col-md-3 control-label">Authors</label>

    <div class="col-md-6">
        <select id="author-ids" class="form-control chosen-select" name="author_ids[]" multiple>
            <?php
                $author_ids = [];

                if(old('author_ids')){
                    $author_ids = old('author_ids');
                } else if(isset($book)){
                    $author_ids = $book->authors->map(function($author){
                        return $author->id;
                    })->toArray();
                }
            ?>
            @foreach($authors as $author)
                <option value="{{ $author->id }}"
                        {{ in_array($author->id,$author_ids)?"selected":"" }}
                    >
                    {{ $author->name }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('author_ids'))
            <span class="help-block">
                <strong>{{ $errors->first('author_ids') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-3">
        <a href="{{ route('authors.index') }}" target="_blank" class="btn btn-primary btn-block">Add new author</a>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-primary">
            Save Book
        </button>
    </div>
</div>