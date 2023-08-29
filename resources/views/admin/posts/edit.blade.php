@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

           <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Insert post title" name="title" value="{{ old( 'title', $post->title) }}">
                </div>

                @error('type_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="type_id" class="form-label">Type</label>
                    <select class="form-select" name="type_id" id="type">
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}" 
                            {{ old('type_id') == $type->id ? 'selected' : '' }}>

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
                    <input type="text" class="form-control" id="image" placeholder="https://example.jpg" name="image" value="{{ old( 'image', $post->image) }}">
                </div>

                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="exampleFormConcontenttrolTextarea1" class="form-label">Content</label>
                    <textarea class="form-control" id="content" rows="8"  name="content" >{{ old( 'content', $post->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <button type="submit">Update Post</button>
                    <button type="reset">Delete</button>
                </div>

           </form>
                        
        </div>
    </div>
</div>
@endsection