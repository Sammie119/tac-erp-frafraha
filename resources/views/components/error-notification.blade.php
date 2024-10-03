@props(['errors'])

@empty($errors)

@else
    <ul class="get-alert">
        @foreach ((array) $errors as $message)
            <span class="text-danger"><li>{{ $message }}</li></span>
        @endforeach
    </ul>
@endempty
