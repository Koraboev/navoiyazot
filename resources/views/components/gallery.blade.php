<div class="row gallery__row">
    <div class="col-md-6 py-2 mb-3 h-100">
        <div class="w-100 h-100 h-animation border-radius-10">
            <img class="w-100 h-100  object-cover object-p-center" src="{{ asset('storage/'.$homeinfo->gallery_image_1) }}" alt="alt">
        </div>
    </div>
    <div class="col-md-3 py-2 mb-3 h-100">
        <div class="w-100 h-100 h-animation border-radius-10">
            <img class="h-100 object-cover object-p-center border-radius-10" src="{{ asset('storage/'.$homeinfo->gallery_image_2) }}" alt="alt">
        </div>
    </div>
    <div class="col-md-3 py-2 mb-3 h-100">
        <div  class="w-100 h-100 h-animation border-radius-10">
            <img class="h-100 object-cover object-p-center border-radius-10" src="{{ asset('storage/'.$homeinfo->gallery_image_3) }}" alt="alt">
        </div>
    </div>
</div>
<div class="row gallery__row">
    <div class="col-md-5 py-2 mb-3 h-100">
        <div class="w-100 h-100 h-animation border-radius-10">
            <img class="w-100 h-100 object-cover object-p-center border-radius-10" src="{{ asset('storage/'.$homeinfo->gallery_image_4) }}" alt="alt">
        </div>
    </div>
    <div class="col-md-7 py-2 mb-3 h-100">
        <div class="w-100 h-100 h-animation border-radius-10">
            <img class="w-100 h-100 object-cover object-p-center border-radius-10" src="{{ asset('storage/'.$homeinfo->gallery_image_5) }}" alt="alt">
        </div>
    </div>
</div>
<div class="row gallery__row">
    <div class="col-md-5 py-2 mb-3 h-100">
        <div class="w-100 h-100 h-animation border-radius-10">
            <img class="w-100 h-100 object-cover object-p-center border-radius-10" src="{{ asset('storage/'.$homeinfo->gallery_image_6) }}" alt="alt">
        </div>
    </div>
    <div class="col-md py-2 mb-3 h-100">
        <div class="w-100 h-100 h-animation border-radius-10">
            <img class="w-100 h-100 object-cover object-p-center border-radius-10" src="{{ asset('storage/'.$homeinfo->gallery_image_7) }}" alt="alt">
        </div>
    </div>
    <div class="col-md py-2 mb-3 h-100">
        <div class="w-100 h-100 h-animation border-radius-10">
            <img class="w-100 h-100 object-cover object-p-center border-radius-10" src="{{ asset('storage/'.$homeinfo->gallery_image_8) }}" alt="alt">
        </div>
    </div>
</div>
<!-- Corusel image -->
<div class="owl-carousel owl-theme text-center mx-auto gallery__carousel d-lg-none">
    <div class="image-wrapper px-1">
        <img class="main-image" src="{{ asset('storage/'.$homeinfo->gallery_image_1) }}" alt="...">
    </div>
    <div class="image-wrapper px-1">
        <img class="main-image" src="{{ asset('storage/'.$homeinfo->gallery_image_2) }}" alt="...">
    </div>
    <div class="image-wrapper px-1">
        <img class="main-image" src="{{ asset('storage/'.$homeinfo->gallery_image_3) }}" alt="...">
    </div>
    <div class="image-wrapper px-1">
        <img class="main-image" src="{{ asset('storage/'.$homeinfo->gallery_image_4) }}" alt="...">
    </div>
    <div class="image-wrapper px-1">
        <img class="main-image" src="{{ asset('storage/'.$homeinfo->gallery_image_5) }}" alt="...">
    </div>
    <div class="image-wrapper px-1">
        <img class="main-image" src="{{ asset('storage/'.$homeinfo->gallery_image_6) }}" alt="...">
    </div>
</div>