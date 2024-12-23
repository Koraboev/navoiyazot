@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)

<section class="pt-2" style="background-color: #f8f9fa">
    <div class="container">
        <div class="section-title wow fadeIn mb-4 mt-3" data-wow-delay="200ms">
            <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('Product catalog') }}</p>
            <h1 class="mb-0 h3">{{ trans('Product catalog') }}</h1>
        </div>
        <div class="row mt-n2-9 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-5">
        @foreach($data as $item)
            <div class="mt-0 wow fadeIn" data-wow-delay="200ms">
                <div class="card-style1 mt-6">
                    <div class="card-main-img h-animation product__img rounded-1">
                        <img src="{{ asset('storage/'.$item->image) }}" alt="...">
                    </div>
                    <div class="card-content">
                    
                        <h3 class="mb-2 h5"><a href="{{ url(app()->getLocale().'/products/'.$item->slug) }}">{{ $item->name }}</a></h3>
                        <a href="{{ url(app()->getLocale().'/products/'.$item->slug) }}">{{ trans('Read More') }} <i class="ti-arrow-right align-middle ms-1"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>

@endsection

