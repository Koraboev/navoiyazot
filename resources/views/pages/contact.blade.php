@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
<!-- EXPERT MECHANICAL
    ================================================== -->
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ trans('Contact us') }}</p>
                <h1 class="mb-0 h3">{{ trans('Contact us') }}</h1>
            </div>
        </div>
    </section>
            <!-- FORM
        ================================================== -->
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 position-relative elements-block mb-6 mb-md-0">
                        <div class="border-start border-width-3 p-3 p-lg-4">

                            <h6 class="small text-uppercase font-weight-600 m-0">{{ trans('Phone number') }}</h6>
                            <br>
                            <p class="fs-14px ps-3">
                                <a class="" href="tel:+998 {{ $contact->number_1 }}">+998 {{ $contact->number_1 }}</a><br><br>
                                <a class="" href="tel:+998 {{ $contact->number_2 }}">+998 {{ $contact->number_2 }}</a>
                            </p>
                            <p class="fs-14px ps-3">
                                <a class="" href="tel:+998 {{ $contact->number_3 }}">+998 {{ $contact->number_3 }}</a><br><br>
                                <a class="" href="tel:+998 {{ $contact->number_4 }}">+998 {{ $contact->number_4 }}</a>
                            </p>

                            <h6 class="small text-uppercase font-weight-600 m-0">{{ trans('e-mail') }}</h6>
                            <br>
                            <p class="fs-14px ps-3">
                                <a class="" href="mailto:{{ $contact->email_1 }}">{{ $contact->email_1 }}</a><br><br>
                                <a class="" href="mailto:{{ $contact->email_2 }} ">{{ $contact->email_2 }}</a>
                            </p>

                            <h6 class="small text-uppercase font-weight-600 m-0">{{ trans('address') }}</h6>
                            <br>
                            <p class="fs-14px ps-3">
                                <a>{{ $contact->address }}</a><br>
                            </p>

                            <h6 class="small text-uppercase font-weight-600 m-0">{{ trans('social media') }}</h6>
                            <br>
                            <ul class="social-icon-style2">
                                <li>
                                    <a href="{{ $contact->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $contact->instagram }}"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $contact->telegram }}"><i class="fab fa-telegram"></i></a>
                                </li>
                                <li>
                                    <a href="{{ $contact->youtube }}"><i class="fab fa-youtube"></i></a>
                                </li>
                            </ul><br><br>
                            
                        </div>

                    </div>

                    <div class="col-md-6">

                    <form action="{{route('form.submit', ['lang' => app()->getLocale()])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input name="formType" type="text" class="d-none" value="{{ trans('Contact us') }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ trans('Your name') }}</label>
                            <input id="name" name="name" class="form-control" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ trans('e-mail') }}</label>
                            <input id="email" name="email" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ trans('Phone number') }}</label>
                            <input id="phone" name="phone" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">{{ trans('Message') }}</label>
                            <textarea name="message" class="form-control" placeholder="{{ trans('Message') }}" id="message" style="height: 100px"></textarea>
                        </div>
                        <br>
                        <button type="submit" class="butn border-0">{{ trans('Send message') }}</button>
                    </form>

                    </div>
                </div>
            </div>

        </section>

@endsection
