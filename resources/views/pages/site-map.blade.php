@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('Sitemap') }}</p>
            </div>
            <div class="row g-5 mt-2">
                <div class="p-1 mt-2">
                    <div class="bg-white rounded-2 p-4">
                        <div>
                            @foreach($data as $item)
                                @if($item->stage == 1)
                                <p><i class="fa fa-folder-open text-primary"></i> {{ $item->name }}</p>
                                    @if($item->type == 'product')
                                        @foreach($categories as $category)
                                            <a href="{{ url(app()->getLocale().'/products-catalog/'.$category->slug) }}"><p class="ms-5"><i class="fa fa-link"></i> {{ $category->name }}</p></a>
                                        @endforeach
                                    @endif
                                    @foreach($data as $item_2)
                                        @if($item_2->stage == 2 && $item_2->parent_id == $item->id)
                                            @if($item_2->type == 'menu')
                                            <p class="ms-5"><i class="fa fa-folder-open text-primary"></i> {{ $item_2->name }}</p>
                                                @foreach($data as $item_3)
                                                    @if($item_3->stage == 3 && $item_3->parent_id == $item_2->id)
                                                        @if($item_3->type == 'menu')
                                                        <p class="ms-10"><i class="fa fa-folder-open text-primary"></i> {{ $item_3->name }}</p>
                                                            @foreach($data as $item_4)
                                                                @if($item_4->stage == 4 && $item_4->parent_id == $item_3->id)
                                                                    @if($item_4->type == 'menu')
                                                                    <p class="ms-15"><i class="fa fa-folder-open text-primary"></i> {{ $item_4->name }}</p>
                                                                    @else
                                                                    <a href="<?php if($item_4->type == 'link') echo $item_4->link;else echo url(app()->getLocale().'/menu-'.$item_4->id.'/'.$page[$item_4->id]);?>"><p class="ms-15"><i class="fa fa-link"></i> {{ $item_4->name }}</p></a>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                        <a href="<?php if($item_3->type == 'link') echo $item_3->link;else echo url(app()->getLocale().'/menu-'.$item_3->id.'/'.$page[$item_3->id]);?>"><p class="ms-10"><i class="fa fa-link"></i> {{ $item_3->name }}</p></a>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                            <a href="<?php if($item_2->type == 'link') echo $item_2->link;else echo url(app()->getLocale().'/menu-'.$item_2->id.'/'.$page[$item_2->id]);?>"><p class="ms-5"><i class="fa fa-link"></i> {{ $item_2->name }}</p></a>
                                            @endif    
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
