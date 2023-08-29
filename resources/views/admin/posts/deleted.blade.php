@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            
            <table class="table table-dark table-striped table-hover rounded-3">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">SLUG</th>
                    <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)

                        <tr>
                            <th>{{ $post->id }}</th>
                            <td class="fw-bold">{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>
                                <form class="d-inline-block" action="{{ route('admin.posts.restore', $post) }}" method="POST">
                                    
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-warning">Restore</button>
                                
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
