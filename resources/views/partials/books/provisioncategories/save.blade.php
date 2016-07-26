{{ csrf_field() }}

<div class="form-group form-inline">
    <input type="text" placeholder="Category Name" name="category_name"
           class="form-control" value="{{ old('category_name')?:(isset($provisionCategory)?$provisionCategory->category_name:'') }}">
    <input type="submit" value="Save Provision Category" class="btn btn-primary">
</div>