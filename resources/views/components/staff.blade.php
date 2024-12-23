<div class="row d-none d-md-flex">
    @foreach($staffes as $staff)
    <div class="col-sm-6 col-md-4 col-lg-3 mt-1-9 wow fadeIn" data-wow-delay="400ms">
        <div class="team-style01">
            <div class="image">
                <img class="staff__img" src="{{ asset('storage/'.$staff->image) }}" alt="...">
            </div>
            <div class="text-center pt-4">
                
                <h3 class="h5 mb-1"><a href="{{ url(app()->getLocale().'/employees/'.$staff->slug) }}">{{ $staff->name }}</a></h3>
                <p class="mb-0">{{ $staff->job }}</p>
            
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- Mobile version corusel -->
<div class="owl-carousel owl-theme text-center mx-auto staff__carousel d-md-none">
    @foreach($staffes as $staff)
    <div class="image-wrapper px-1">
        <div class="team-style01">
            <div class="image">
                <img class="staff__img" src="{{ asset('storage/'.$staff->image) }}" alt="...">
            </div>
            <div class="text-center pt-4">
                <h3 class="h5 mb-1"><a href="{{ url(app()->getLocale().'/employees/'.$staff->slug) }}">{{ $staff->name }}</a></h3>
                <p class="mb-0">{{ $staff->job }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>