@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)

<section class="pt-2">
    <div class="container">
        <div class="section-title wow fadeIn mb-4 mt-3" data-wow-delay="200ms">
            <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('Our leaders') }}</p>
            <h1 class="mb-0 h3">{{ trans('Our leaders') }}</h1>
        </div>
        <div class="row">
            @foreach($staffs as $staff)
                <div class="card mt-3">
                    <div class="row">
                        <div class="col-md-3 px-0 pt-3">
                            <img src="{{ asset('storage/'.$staff->image) }}" class="comment__card__img img-fluid rounded-start h-100 object-cover object-p-top w-100 w-lg-auto" alt="...">
                        </div>
                        <div class="col-md-9 px-0">
                            <div class="card-body">
                                <h5 class="card-title fs-4 m-0">{{ $staff->name }}</h5>
                                <p class="fs-14px mb-3">{{ $staff->job }}</p>
                                <a href="tel:{{ $staff->number }}"><p><i class="fa fa-phone"></i> +998 {{ $staff->number }}</p></a>
                                <a href="mailto:{{ $staff->email }}"><p><i class="fa fa-envelope"></i> {{ $staff->email }}</p></a>
                                <a><p><i class="fa fa-sms"></i> {{ $staff->messenger }}</p></a>
                            </div>
                            <p class="text-end"><button type="button" class="show-staff-details btn btn-secondary btn-sm mb-3 mr-3 rounded-0">{{ trans('Read More') }}</button></p>
                            <nav class="staff-details d-none">{!! $staff->info !!}</nav>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        {{ $staffs->links("pagination::bootstrap-4") }}
    </div>

</section>
@endsection
