@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > <a href="{{ url(app()->getLocale().'/posts-'.$type) }}">{{ trans($type) }}</a> > {{ $post->title }}</p>
            </div>
            <div class="row g-5 mt-2">
                <div class="col-md-8 p-1 mt-2">
                    <div class="bg-white rounded-2 p-4">
                        <h5 class="text-center">{{ $post->title }}</h5>
                        <div>
                            @if(count($post->image) > 1)
                            <div id="carouselExampleAutoplaying" class="carousel slide mx-auto w-60" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    
                                    <div class="carousel-item active">
                                        <a href="{{ asset('storage/'.$post->image[0]) }}" class="popup-image-gallery" data-fancybox="gallery">
                                            <img src="{{ asset('storage/'.$post->image[0]) }}" style="max-height: 300px;max-width: 100%;object-fit: cover;" class="d-block w-100" alt="...">
                                        </a>
                                    </div>
                                    @foreach($post->image as $img)
                                    <div class="carousel-item">
                                        <a href="{{ asset('storage/'.$img) }}" class="popup-image-gallery" data-fancybox="gallery">
                                            <img src="{{ asset('storage/'.$img) }}" class="d-block w-100" style="max-height: 300px;max-width: 100%;object-fit: cover;" alt="...">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            @endif

                            <p>{!! $post->text !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 px-4 py-1 mt-2">
                    <div class="bg-white rounded-2 p-4 pb-1">
                        <h4 class="post__recent__post__title pb-2 display-25 position-relative">{{ trans($type) }}</h4>
                        @foreach($posts as $item)
                            @if($item->id != $post->id)
                            <a href="{{ url(app()->getLocale().'/posts-'.$type.'/'.$item->slug) }}">
                                <div class="mt-2">
                                    <p class="mb-1">{{ Str::limit($item->title, 70) }}</p>
                                    <span class="fs-14px">{{ $item->created_at->format('d.m.Y') }}</span>
                                </div>
                            </a>
                            @endif
                        @endforeach
                        <script>
                            $(document).ready(function() {
                                $('.popup-image-gallery').magnificPopup({
                                    type: 'image',
                                    gallery: {
                                        enabled: true, // Galereyani yoqish
                                        navigateByImgClick: true, // Rasmga bosish orqali o'tkazish
                                        preload: [0, 1] // Old va keyingi rasmlarni oldindan yuklash
                                    },
                                    closeOnContentClick: true, // Rasmga bosganda yopish
                                    closeBtnInside: true, // Yopish tugmasi rasm ichida bo'lishi
                                    // Agar kerak bo'lsa, tugmachalar uchun ko'rsatmalar:
                                    callbacks: {
                                        beforeOpen: function() {
                                            this.st.mainClass = this.st.el.attr('data-effect'); // Animatsiya effektini o'rnatish
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
