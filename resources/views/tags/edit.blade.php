@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Edit Tag</div>
        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                     name="name" id="name"
                     value="{{old('name', $tag->name)}}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>

@endsection
