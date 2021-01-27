<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verifyCategoriesCount'])->only('create', 'store');
        $this->middleware(['validateAuthor'])->only('edit', 'update', 'destroy', 'trash');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->isAdmin()) {
            $posts = Post::withoutTrashed()->where('user_id', auth()->id())->paginate(10);
        } else {
            $posts = Post::paginate(10);
        }
        return view('posts.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact(['categories', 'tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image')->store('posts');

        $post = Post::create([
            'title'=>$request->title,
            'user_id' => auth()->id(),
            'excerpt'=>$request->excerpt,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'image'=> $image,
            'published_at'=>$request->published_at,
        ]);
        if($request->tags) {
            $post->tags()->attach($request->tags);
        }
        session()->flash('success', 'Post Created Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact(['post', 'categories', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $data = $request->only(['title', 'excerpt', 'content','category_id', 'published_at']);
        if($request->hasFile('image'))
        {
            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        if($request->tags) {
            $post->tags()->sync($request->tags);
        }
        $post->update($data);
        session()->flash('success', 'Post Updated Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success', 'Post Deleted Successfully');
        return redirect()->back();

    }

    /**
     * Soft Delete the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function trash(Post $post) {
        $post->delete();
        session()->flash('success', 'Post trashed Successfully');
        return redirect(route('posts.index'));

    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function restore($id) {

        $trashedPost = Post::onlyTrashed()->find($id);
        $trashedPost->restore();
        session()->flash('success', 'Post restored Successfully');
        return redirect(route('posts.index'));

    }

    /**
     *  Display soft deleted list of the resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function trashed() {
        $trashed = Post::onlyTrashed()->paginate(10);
        return view('posts.trashed')->with('posts',$trashed);
    }
}
