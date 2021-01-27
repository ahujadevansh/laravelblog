<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;

class WelcomeController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $posts = Post::search()->published()->latest('published_at')->simplePaginate(2);
        return view('blog.index', compact(['posts', 'tags', 'categories']));
    }
    public function category(Category $category)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $posts = $category->posts()->simplePaginate(2);
        return view('blog.index', compact(['posts', 'tags', 'categories']));
    }
    public function tag(Category $tag)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $posts = $tag->posts()->simplePaginate(2);
        return view('blog.index', compact(['posts', 'tags', 'categories']));
    }

    public function show(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('blog.post', compact(['post', 'tags', 'categories']));
    }
}
