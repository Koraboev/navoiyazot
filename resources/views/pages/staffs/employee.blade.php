@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)

<section class="pt-2">
    <div class="container">
        <div class="section-title wow fadeIn mb-4 mt-3" data-wow-delay="200ms">
            <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('Our leaders') }}</p>
            <h1 class="mb-0 h3">{{ $staff->name }}</h1>
        </div>
        <div class="row gx-xxl-5">

                <div class="card">
                    <div class="row">
                        <div class="col-md-3 px-0 pt-3">
                            <img src="{{ asset('storage/'.$staff->image) }}" class="comment__card__img img-fluid rounded-start h-100 object-cover object-p-top w-100 w-lg-auto" alt="...">
                        </div>
                        <div class="col-md-9 px-0">
                            
                            <div class="card-body text-center py-3 py-sm-5 ps-3 ps-sm-4 p-md-3 text-sm-start">
                                <h5 class="card-title fs-4 m-0">{{ $staff->name }}</h5>
                                <p class="fs-14px mb-3">{{ $staff->job }}</p>
                                <a href="tel:{{ $staff->number }}"><p><i class="fa fa-phone"></i> +998 {{ $staff->number }}</p></a>
                                <a href="mailto:{{ $staff->email }}"><p><i class="fa fa-envelope"></i> {{ $staff->email }}</p></a>
                                <a><p><i class="fa fa-sms"></i> {{ $staff->messenger }}</p></a>
                            </div>
                            <p>{!! $staff->info !!}</p>
                        </div>
                    </div>
                </div>

        </div>
    </div>

</section>
@endsection
