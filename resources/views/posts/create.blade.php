@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Add Post</div>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                     name="title" id="title"
                     value="{{old('title')}}">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror"
                            name="excerpt" id="excerpt" cols="30" rows="3">{{old('excerpt')}}</textarea>
                @error('excerpt')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="hidden" name="content" id="content" value="{{old('content')}}">
                    <trix-editor input="content"></trix-editor>
                @error('content')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control @error('category_id') is-invalid @enderror"
                     name="category_id" id="category_id">
                        <option disabled checked>Select Category...</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ $category->id == old('category_id')? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="form-control @error('tags') is-invalid @enderror"
                     name="tags[]" id="tags" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @error('tags')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="published_at">Published at</label>
                    <input type="text" class="form-control @error('published_at') is-invalid @enderror"
                     name="published_at" id="published_at"
                     value="{{old('published_at')}}">
                @error('published_at')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                     name="image" id="image"
                     value="{{old('image')}}">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </form>
    </div>

@endsection

@section('page-level-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('page-level-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
flatpickr("#published_at", {
enableTime: true
});
$(document).ready(function() {
    $('#category_id').select2();
});
$(document).ready(function() {
    $('#tags').select2();
});
</script>
@endsection
