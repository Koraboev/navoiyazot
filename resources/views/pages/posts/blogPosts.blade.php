@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)

<section class="pt-2">
    <div class="container">
        <div class="section-title wow fadeIn mb-4 mt-3" data-wow-delay="200ms">
            <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans($type) }}</p>
            <h1 class="mb-0 h3">{{ trans($type) }}</h1>
        </div>
        
        <div class="row">
        @foreach($posts as $post)
            <nav class="col-md-4 mb-4">
                <a href="{{ url(app()->getLocale().'/posts-'.$type.'/'.$post->slug) }}">
                    <div class="card">
                        <div class="card-body text-center py-3 py-sm-5 ps-3 ps-sm-4 p-md-3 text-sm-start">
                            <h5 class="card-title mb-2">{{ Str::limit($post->title, 30) }}</h5>
                            <p class="card-text fs-14px">{!! Str::limit(strip_tags($post->text), 150) !!}</p>
                            <i class="fs-14px">{{ $post->created_at->format('d.m.Y') }}</i>
                        </div>
                    </div>
                </a>
            </nav>
        @endforeach
        </div>
        <br>
    {{ $posts->links("pagination::bootstrap-4") }}
    </div>
    
</section>

@endsection
