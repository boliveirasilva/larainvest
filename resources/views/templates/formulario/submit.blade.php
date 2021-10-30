@php
    $class = (isset($class) ? $class : null);
@endphp

<label class="{{ $class }} submit">
    {!! Form::submit($input) !!}
</label>

