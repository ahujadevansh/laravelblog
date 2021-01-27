@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Add Tag</div>
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                     name="name" id="name"
                     value="{{old('name')}}">
                @error('name')
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
