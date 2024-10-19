@props(['value', 'label', 'message', 'name', 'type', 'disabled' => false,'required' => true])

<div {{ $attributes->merge(['class' => 'mb-4 relative']) }}>
    <label for={{ $name }} class='block font-medium text-sm text-black/80'> {{ $label }} </label>
    @if ($type == 'textarea')
        <textarea {{ $required ? 'required' : '' }} id="{{ $name }}" name="{{ $name }}"
            class='border-x-0 border-t-0 border-gray-500 w-11/12 min-h-40 max-h-40 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md @error($name) is-invalid @enderror'>{{ old($name,$value) }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }}
            class='border-x-0 border-t-0 border-gray-500 w-10/12 h-12 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md @error($name) is-invalid @enderror'
            value="{{ old($name, $value) }}" />
    @endif

    @error($name)
        <div class='invalid-tooltip text-red-600'>{{$message}}</div>
    @enderror
</div>
