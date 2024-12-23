@foreach($reviews as $review)
<div class="card mb-3 mx-2 mx-mg-3 overflow-hidden">
    
    <div class="row">
        <div class="col-md-5 px-0">
        <img src="{{ asset('storage/'.$review->image) }}" class="comment__card__img img-fluid rounded-start h-100 object-cover object-p-top w-100 w-lg-auto" alt="...">
        </div>
        <div class="col-md-7 px-0">
        <div class="card-body text-center py-3 py-sm-5 ps-3 ps-sm-4 p-md-3 text-sm-start">
            <span class="fs-14px">{{ $review->created_at->format('d.m.Y') }}</span>
            <a href="{{ url(app()->getLocale().'/reviews/'.$review->slug) }}"><h5 class="card-title fs-4 m-0">{{ $review->name }}</h5></a>
            <p class="fs-14px mb-3">{{ $review->company }}</p>
            <p class="card-text fs-14px">{!! Str::limit(strip_tags($review->text), 120) !!}</p>
        </div>
        </div>
    </div>

</div>
@endforeach