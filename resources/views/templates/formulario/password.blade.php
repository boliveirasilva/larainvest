
{{--<label class="{{ $class or null }}">--}}
{{--    <span>{{ $label or $input or "ERRO" }}</span>--}}
{{--    {!! Form::password($input, $attributes) !!}--}}
{{--</label>--}}

@php
    $class = (isset($class) ? $class : null);
    $label = (isset($label) ? $label : (isset($input) ? $input : "ERRO"));
@endphp

<label class="{{ $class }}">
    <span>{{ $label }}</span>
    {!! Form::password($input, $attributes) !!}
</label>
