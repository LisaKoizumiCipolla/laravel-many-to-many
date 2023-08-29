@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

           <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Insert post title" name="title" value="{{ old('title', '') }}">
                </div>

                @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="type_id" class="form-label">Type</label>
                    <select class="form-select" name="type_id" id="type">
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label> 
                    <!-- <input type="text" class="form-control" id="image" placeholder="https://example.jpg" name="image"> -->
                    <input type="file" name="image" id="image" class="form-control" placeholder="Upload your image" value="{{ old('image', '') }}"> 
                </div>

                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="exampleFormConcontenttrolTextarea1" class="form-label">Content</label>
                    <textarea class="form-control" id="content" rows="8"  name="content"> {{ old('content', '') }}</textarea>
                </div>

                <div class="mb-3">
                    <button type="submit">Create Post</button>
                    <button type="reset">Reset</button>
                </div>

           </form>
                        
        </div>
    </div>
</div>
@endsection