@props(['label', 'value', 'message', 'name', 'options'])

<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    <label for="{{ $name }}" class="block font-medium text-sm text-black/80"> {{ $label }} </label>
    <select name="{{ $name }}[]" id="{{ $name }}" multiple
        class='border-x-0 border-t-0 border-gray-500 w-10/12 h-12 mb-2 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md'>

        @foreach ($options as $option)
            <option value="{{ $option->id }}" @selected(collect(old($name,$value))->contains($option->id))>
                {{ $option->name ? Str::ucfirst($option->name) : Str::ucfirst($option->title) }}</option>
        @endforeach
    </select>
    @error($name)
        <div class='text-red-500'>{{ $message }}</div>
    @enderror
</div>
