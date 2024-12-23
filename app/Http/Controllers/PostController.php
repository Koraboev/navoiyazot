<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post($lang, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $posts = Post::where('lang', $lang)->where('type', 'post')->skip(0)->take(10)->get();
        if($post->seo)
        {
            $metaTitle = $post->seo_title;
            $metaDescription = $post->seo_description;
        }
        else
        {
            $metaTitle = $post->title;
            $metaDescription="";
        }
        return view('pages.posts.post', compact('posts','post','metaTitle', 'metaDescription'));
    }

    // post function

    public function posts($lang)
    {
        $posts = Post::where('lang', $lang)->where('type', 'post')->paginate(12);
        
        {
            $metaTitle = trans('news');
            $metaDescription="";
        }
        return view('pages.posts.posts', compact('posts','metaTitle', 'metaDescription'));
    }

    // other posts
    public function blogPosts($lang, $type)
    {   
        $posts = Post::where('lang', $lang)->where('type', $type)->paginate(12);
        
        {
            $metaTitle = trans($type);
            $metaDescription="";
        }
        return view('pages.posts.blogPosts', compact('posts','type','metaTitle', 'metaDescription'));
    }

    public function blogPost($lang, $type, $slug)
    {
        $post = Post::where('slug', $slug)->where('type', $type)->firstOrFail();
        $posts = Post::where('lang', $lang)->where('type', $type)->skip(0)->take(10)->get();
        if($post->seo)
        {
            $metaTitle = $post->seo_title;
            $metaDescription = $post->seo_description;
        }
        else
        {
            $metaTitle = $post->title;
            $metaDescription="";
        }
        return view('pages.posts.blogPost', compact('posts','post','type','metaTitle', 'metaDescription'));
    }
}
