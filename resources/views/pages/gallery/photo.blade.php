@extends('layouts.layout')
@section('content')
@section('title', $metaTitle)
@section('description', $metaDescription)
<!-- EXPERT MECHANICAL
    ================================================== -->
    <section class="pt-4 pb-3" style="background-color: #f8f9fa">
        <div class="container">
            <div class="section-title wow fadeIn" data-wow-delay="200ms">
                <p class="mb-2"><a href="/">{{ trans('Home') }}</a> > {{ $data->name }} </p>
                <h1 class="mb-0 h3">{{ $data->name }}</h1>
            </div>
            <div class="row mt-4 p-3" style="background-color: #fff;">
                @foreach($data->images as $item)
                <div class="col-md-3">
                    <a href="{{ asset('storage/'.$item) }}" class="popup-image-gallery" data-fancybox="gallery">
                        <div class="mt-1-9 wow fadeIn" data-wow-delay="400ms">
                            <div class="team-style01">
                                <div class="image rounded-0">
                                    <img class="staff__img" src="{{ asset('storage/'.$item) }}" alt="...">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
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
    </section>

@endsection