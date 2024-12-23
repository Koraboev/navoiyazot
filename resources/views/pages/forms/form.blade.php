@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
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
                <form action="{{route('form.submit', ['lang' => app()->getLocale()])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input name="formType" type="text" class="d-none" value="{{ $menu->name }}">
                        <div class="mb-3 <?= $menu->type=='consumer'?'d-none':''?>">
                            <label for="name" class="form-label">{{ trans('Your name') }}</label>
                            <input id="name" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ trans('e-mail') }}</label>
                            <input id="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3 <?=($menu->type=='consumer' or $menu->type=='appointment')?'d-none':''?>">
                            <label for="subject" class="form-label">{{ trans('Subject') }}</label>
                            <input id="subject" name="subject" class="form-control" >
                        </div>
                        <div class="mb-3 <?=($menu->type=='feedback' or $menu->type=='appointment')?'d-none':''?>">
                            <label for="phone" class="form-label">{{ trans('Phone number') }}</label>
                            <input id="phone" name="phone" class="form-control" id="exampleInputPassword1">
                        </div>

                        <div class="mb-3 <?=($menu->type=='feedback' or $menu->type=='consumer')?'d-none':''?>">
                            <label for="yourCompany" class="form-label">{{ trans('Company') }}</label>
                            <input id="yourCompany" name="company" class="form-control" >
                        </div>
                        <div class="mb-3 <?=($menu->type=='feedback' or $menu->type=='consumer')?'d-none':''?>">
                            <label for="yourJob" class="form-label">{{ trans('Your Job') }}</label>
                            <input id="yourJob" name="job" class="form-control" >
                        </div>
                        <div class="mb-3 <?=($menu->type=='feedback' or $menu->type=='consumer')?'d-none':''?>">
                            <label for="whom" class="form-label">{{ trans('Whom') }}</label>
                            <select id="whom" name="whom" class="form-control">
                                <option>{{ trans('Who to see') }}</option>
                                <option value="Председатель правления">{{ trans('Chairman of the Board') }}</option>
                                <option value="Председатель профсоюзного комитета">{{ trans('Chairman of the Trade Union Committee') }}</option>
                                <option value="Директор по финансам">{{ trans('Director of Finance') }}</option>
                                <option value="Директор по КС, социальным вопросам и РПП">{{ trans('Director of KS, Social Issues and RPP') }}</option>
                                <option value="Начальник управления кадров">{{ trans('Head of the HR Department') }}</option>
                            </select>
                        </div>
                        <div class="mb-3 <?=($menu->type=='feedback' or $menu->type=='appointment')?'d-none':''?>">
                            <label for="product" class="form-label">{{ trans('Product') }}</label>
                            <input id="product" name="product" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">{{ trans('Message') }}</label>
                            <textarea name="message" class="form-control" placeholder="{{ trans('Message') }}" id="message" style="height: 100px"></textarea>
                        </div>
                        {!! $pageData->description !!}
                        <br>
                        <button type="submit" class="butn border-0">{{ trans('Send message') }}</button>
                    </form>

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
