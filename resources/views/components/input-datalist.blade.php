@props(['options'=> [], 'placeholder' => '', 'list', 'value' => ''])

<input type="text" {!! $attributes->merge(['class'=>'form-control form-control-border']) !!} value="{{ $value }}" list="{{ $list }}" placeholder="{{$placeholder}}" autofocus>
<datalist id="{{ $list }}">
    @forelse ($options as $option)
        <option value="{{ $option->name }}">
    @empty
        <option value="No Data Found">
    @endforelse
</datalist>
