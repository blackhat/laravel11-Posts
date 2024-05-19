<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;


class PostController extends Controller
{
    public function index()

    {
        // $posts = Post::all();

        // $posts = Post::with('user')->get();
        $posts = Post::with('user')->latest()->get();
        // dd(PostResource::collection($posts));

        return inertia()->render('Posts/Index',[
            // 'greeting' => 'Hello Laravel+Vue+Inertia',
            // 'posts' => $posts,       //object

            // pss with resource
            'posts' => PostResource::collection($posts),
            'now' => now(),
            'can' => [
                'post_create' => auth()->user()->can('create', Post::class)

            ]


        ]);


    }

    public function store(StorePostRequest $request)
    {

        // sleep(3);
        auth()->user()->posts()->create($request->validated());

        // return redirect()->route('posts.index');
        return redirect()->route('posts.index')->with('message',[
            'type' => 'success',
            'body' => 'Post created successfully'
        ]);


    }

}
