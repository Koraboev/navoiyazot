
@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
<!-- ERROR PAGE
================================================== -->
<section class="p-0 bg-img bg-secondary cover-background" data-background="img/content/error-page.png">
    <div class="container d-flex flex-column position-relative z-index-9">
        <div class="row align-items-center min-vh-100 text-center justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="bg-white px-1-9 px-sm-6 py-7 border-radius-10">
                    <h1 class="error-text">404</h1>
                    <h2 class="mb-1-9">Oops! This Page is Not Found.</h2>
                    <a href="index.html" class="butn"><span>Home Page</span></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
