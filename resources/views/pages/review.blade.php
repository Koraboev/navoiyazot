@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > <a href="{{ url(app()->getLocale().'/reviews') }}">{{ trans('Customer Reviews') }}</a> > {{ $review->company }}</p>
            </div>
            <div class="row g-5 mt-2">
                <div class="col-md-8 col-12 p-1 mt-2">
                    <div class="bg-white rounded-2 p-4">
                        <h5 class="text-center">{{ $review->name }}</h5>
                        <img src="{{ asset('storage/'.$review->image) }}" alt="">
                        <div>
                            <p>{!! $review->text !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 px-4 py-1 mt-2">
                    <div class="bg-white rounded-2 p-4 pb-1">
                        <h4 class="post__recent__post__title pb-2 display-25 position-relative mb-3">{{ trans('Customer Reviews') }}</h4>
                        @foreach($reviews as $item)
                            @if($review->id != $item->id)

                                <div class="post__recent__post__card row">
                                    <a href="{{ url(app()->getLocale().'/reviews/'.$item->slug) }}">                                        
                                        <p class="lh-base mb-1">{{ Str::limit($item->name, 50) }}</p>
                                        <span class="fs-14px">{{ $item->company }}</span>
                                    </a>
                                </div>

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
