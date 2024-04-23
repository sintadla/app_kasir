@props(['name' => null, 'value' => null])

@php
    $isInvalid = $errors->has($name) ? 'is-invalid' : '';
@endphp

<input name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control form-control-sm ' . $isInvalid]) }} value="{{ old($name, $value) }}" />

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
