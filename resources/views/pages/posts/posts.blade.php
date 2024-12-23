@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)

<section class="pt-2">
    <div class="container">
        <div class="section-title wow fadeIn mb-4 mt-3" data-wow-delay="200ms">
            <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('news') }}</p>
            <h1 class="mb-0 h3">{{ trans('news') }}</h1>
        </div>
        
        <div class="row mt-n2-9 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-5">
        @foreach($posts as $post)
           
            <a href="{{ url(app()->getLocale().'/posts/'.$post->slug) }}">
                <div class="card">
                    <img style="max-height: 150px;object-fit: cover;object-position:center" class="card-img-top" src="{{ asset('storage/'.$post->image[0]) }}" alt="image">
                    <div class="card-body">
                        <p class="card-text">{{ Str::limit($post->title, 50) }}</p>
                    </div>
                </div>
            </a>
        @endforeach
        </div>
        <br>
    {{ $posts->links("pagination::bootstrap-4") }}
    </div>
    
</section>


@endsection
