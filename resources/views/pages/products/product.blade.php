@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
<!-- EXPERT MECHANICAL
    ================================================== -->
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > <a href="{{ url(app()->getLocale().'/products-catalog') }}">{{ trans('Product catalog') }}</a> > <a href="{{ url(app()->getLocale().'/products/'.$category->slug) }}">{{ $category->name }}</a> > {{ $product->name }}</p>
                <h1 class="mb-0 h3">{{ $product->name }}</h1>
            </div>
            <div class="row mt-4">
                <div class="col-xl-8 mb-2-9 mb-xl-0 order-1 order-xl-1 rounded-2 p-4" style="background-color: #fff">
                    {!! $product->info !!}
                </div>
                <div class="col-xl-4 order-2 order-xl-2">
                    <div class="sidebar me-xxl-1-9">
                        <div class="widget mb-1-9 wow fadeInUp" data-wow-delay="200ms">
                            <div class="widget-content">
                                <div class="section-title">
                                    <h5 class="text-brand mb-4"></h5>
                                </div>
                                <ul class="category-list list-unstyled mb-0 post__link__hover">
                                    @foreach($data as $item)
                                    <li class="<?= $item->id == $product->id ? 'post__active':''?>"><a href="{{ url(app()->getLocale().'/product/'.$item->slug) }}">{{ $item->name }}<span class="ti-arrow-right"></span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
