@foreach($partners as $partner)
    <a href="{{ $partner->link }}">
        <div class="image-wrapper">
            <img class="main-image" src="{{ asset('storage/'.$partner->image) }}" alt="...">
        </div>
    </a>
@endforeach