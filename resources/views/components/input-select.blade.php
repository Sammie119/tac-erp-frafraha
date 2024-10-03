@props(['options'=> [], 'selected' => 0])
<select {!! $attributes->merge(['class'=>'form-control']) !!}>
    <option selected disabled>--Select--</option>
    @foreach ($options as $option)
        <option @if ($selected == $option->id) selected @endif value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
</select>
