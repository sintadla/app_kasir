@props(['name' => null, 'value' => null])

@php
    $isInvalid = $errors->has($name) ? 'is-invalid' : '';
@endphp

<textarea name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control form-control-sm ' . $isInvalid]) }}>{{ old($name, $value) }}</textarea>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
