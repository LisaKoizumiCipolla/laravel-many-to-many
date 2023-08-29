<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Post;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $types = Type::all();
        $technologies = Technology::all();
        return view ('admin.posts.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

       // $technologies = Technology::all()->pluck('id')->toArray();

        $data = $request->validate([
            'title' => ['required', 'unique:posts', 'min:10', 'max:255'],
            'image' => ['required', 'image'],
            'content' => ['required', 'min:10'],
            'technologies' => ['exists:technologies,id'],
            'type_id' => ['required', 'exists:types,id']
        ]);


        $img_path = Storage::put('uploads', $request['image']);

        $data['image'] = $img_path;
        $data["slug"] = Str::of($data['title'])->slug('-');

        $newPost = Post::create($data);

        if ($request->has('technologies')){
            $newPost->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.posts.show');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.edit', compact('post', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $data = $request->validate([
            'title' => ['required', 'min:2', Rule::unique('posts')->ignore($post->id), 'max:255'],
            'image' => ['url:https'],
            'content' => ['required', 'min:10'],
            'technologies' => ['exists:technologies,id'],
            'type_id' => ['required', 'exists:types,id']
        ]);

        $data["slug"] = Str::of($data['title'])->slug('-');

        $post->update($data);

        if ($request->has('technologies')){
            $post->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
            $post->delete();
            return redirect()->route('admin.posts.index');

    }

    public function deletedIndex(){
        $posts = Post::onlyTrashed()->paginate(10);

        return view('admin.posts.deleted', compact('posts'));
    }

    public function restore($id){
        $post = Post::onlyTrashed()->findOrFail($id);

        $post->restore();

        return redirect()->route('admin.posts.show', $post);

    }
}
