
{{--<label class="{{ $class ?? null }}">--}}
{{--    <span>{{ $label ?? $select ?? "ERRO" }}</span>--}}
{{--    {!! Form::text($input, $value ?? null, $attributes) !!}--}}
{{--</label>--}}

@php
  $class = (isset($class) ? $class : null);
  $label = (isset($label) ? $label : (isset($select) ? $select : "ERRO"));
  $data = (isset($data) ? $data : []);
@endphp

<label class="{{ $class }}">
    <span>{{ $label }}</span>
    {!! Form::select($select, $data) !!}
</label>


