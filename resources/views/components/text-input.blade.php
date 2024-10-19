@props(
['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(
    ['class' => 'border-x-0 border-t-0 border-gray-500 w-10/12 h-12 mb-4 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md']) 
!!}>
