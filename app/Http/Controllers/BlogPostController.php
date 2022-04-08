<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Http\Requests\BlogPostRequest;
use Illuminate\Database\Eloquent\Collection ;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts = null ;
        if (Auth::user()->privilege == 'Admin') {
            $blogPosts = BlogPost::orderBy('created_at', 'DESC')->get() ;
        } else {
            $blogPosts = Auth::user()->blogPosts()->orderBy('created_at', 'DESC')->get() ;
        }
        return view('/dashboard')->with('blogPosts',$blogPosts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/blog-posts/create-blog-post') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BlogPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostRequest $request)
    {
        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('/blog-posts/update-blog-post')->with('blogPost',$blogPost) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogPostRequest  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostRequest $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect('/dashboard');
    }
}
