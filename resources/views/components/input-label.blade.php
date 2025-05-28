@props(['value'])

<label {{ $attributes->class(['block', 'font-medium', 'text-sm']) }}>
    {{ $value ?? $slot }}
</label>

