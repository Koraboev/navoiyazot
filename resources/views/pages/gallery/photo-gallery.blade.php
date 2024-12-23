@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
<!-- EXPERT MECHANICAL
    ================================================== -->
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('Gallery') }} </p>
                <h1 class="mb-0 h3"> {{ trans('Gallery') }} </h1>
            </div>
            <div class="row mt-4">
                @foreach($data as $item)
                <div class="col-md-4">
                    <a href="{{ url(app()->getLocale().'/photo-gallery/'.$item->slug) }}">
                        <div class="sidebar-banner bg-img cover-background mb-1-9 wow fadeInUp" data-background="{{ asset('storage/'.$item->images[0]) }}" data-wow-delay="350ms">
                            <div class="content d-flex align-items-center">
                                <!-- <div class="flex-shrink-0">
                                    <img src="" alt="...">
                                </div> -->
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="text-white mb-1">{{ $item->created_at->format('d.m.Y') }}</h4>
                                    <span class="text-white">{{ $item->name }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection