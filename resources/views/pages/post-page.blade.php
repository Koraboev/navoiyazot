@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
<style>
    .modal-90{
        max-width: 90%;
    }
</style>
<!-- EXPERT MECHANICAL
    ================================================== -->
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ $pageData->title }}</p>
                <h1 class="mb-0 h3">{{ $pageData->title }}</h1>
            </div>
            <div class="row mt-4">
                <div class="col-xl-8 mb-2-9 mb-xl-0 order-1 order-xl-1 rounded-2 p-4" style="background-color: #fff">
                    {!! $pageData->description !!}
                    @if(!empty($vacancies))
                    <ul>
                        @foreach($vacancies as $vacancy)
                        <li>
                            <a style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#modal-{{ $vacancy->id }}">{{ $vacancy->title }}</a>
                        </li>
                        <!-- Modal -->
                        <div style="max-height:95vh;" class="modal fade" id="modal-{{ $vacancy->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $vacancy->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-90">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel-{{$vacancy->id}}">{{ $vacancy->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="overflow-y: scroll;">
                                        {!! $vacancy->description !!}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </ul>                 
                @endif
                </div>
                <div class="col-xl-4 order-2 order-xl-2">
                    <div class="sidebar me-xxl-1-9">
                        <div class="widget mb-1-9 wow fadeInUp" data-wow-delay="200ms">
                            <div class="widget-content">
                                <div class="section-title">
                                    <h5 class="text-brand mb-4">{{ $parentMenu->name }}</h5>
                                </div>
                                <ul class="category-list list-unstyled mb-0 post__link__hover">
                                    @foreach($menus as $item)
                                    <li class="<?= $item->id == $menu->id ? 'post__active':''?>"><a href="<?php if($item->type == 'menu') echo '#';elseif($item->type == 'link') echo $item->link;else echo url(app()->getLocale()."/menu-$item->id/".$page[$item->id]);?>">{{ $item->name }}<span class="<?=$item->type=='menu'?'ti-menu':'ti-arrow-right'?>"></span></a></li>
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
