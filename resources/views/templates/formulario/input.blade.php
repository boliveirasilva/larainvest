
{{--<label class="{{ $class ?? null }}">--}}
{{--    <span>{{ $label ?? $input ?? "ERRO" }}</span>--}}
{{--    {!! Form::text($input, $value ?? null, $attributes) !!}--}}
{{--</label>--}}

@php
  $class = (isset($class) ? $class : null);
  $label = (isset($label) ? $label : (isset($input) ? $input : "ERRO"));
  $value = (isset($value) ? $value : null);
@endphp

<label class="{{ $class }}">
    <span>{{ $label }}</span>
    {!! Form::text($input, $value, $attributes) !!}
</label>


