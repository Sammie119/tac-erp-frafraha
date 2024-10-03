@props(['modal_title', 'modal_url', 'modal_size', 'button_title', 'button_description', 'button_color'])

<a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="{{ $modal_title }}" data-bs-url="{{ $modal_url }}" data-bs-size="{{ $modal_size }}">
    <div class="small-box {{ $button_color }}" style="height: 150px">
        <div class="inner" style="padding-left: 20px; padding-top: 30px">
            <h3>{{ $button_title }}</h3>
            <p>{{ $button_description }}</p>
        </div>
        <div class="small-box-icon">
            {{ $slot }}
        </div>
    </div> <!--end::Small Box Widget 1-->
</a>
