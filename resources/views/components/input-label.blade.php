@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-black/80']) }}>
    {{ $value ?? $slot }}
</label>
