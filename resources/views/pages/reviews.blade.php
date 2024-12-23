@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)

<section class="pt-2">
    <div class="container">
        <div class="section-title wow fadeIn mb-4 mt-3" data-wow-delay="200ms">
            <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('Customer Reviews') }}</p>
            <h1 class="mb-0 h3">{{ trans('Customer Reviews') }}</h1>
        </div>
        <div class="row gx-xxl-5">
            @foreach($reviews as $review)
            <nav class="col-md-6 mb-4">
                <div class="card">
                    <div class="row">
                        <div class="col-md-5 px-0">
                            <img src="{{ asset('storage/'.$review->image) }}" class="comment__card__img img-fluid rounded-start h-100 object-cover object-p-top w-100 w-lg-auto" alt="...">
                        </div>
                        <div class="col-md-7 px-0">
                            <div class="card-body">
                                <a href="{{ url(app()->getLocale().'/reviews/'.$review->slug) }}"><h5 class="card-title fs-4 m-0">{{ $review->name }}</h5></a>
                                <a href="{{ url(app()->getLocale().'/reviews/'.$review->slug) }}"><p class="fs-14px mb-3">{{ $review->company }}</p></a>
                                <p class="card-text fs-14px">{!! Str::limit(strip_tags($review->text), 150) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            @endforeach
        </div>
        <br>
        {{ $reviews->links("pagination::bootstrap-4") }}
    </div>

</section>
@endsection
