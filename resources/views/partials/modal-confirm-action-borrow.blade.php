@php
    $name ?? '';
    $text ?? '';
    $route ?? '';
@endphp


<div id="{{$name}}Modal" class="modal">

    <p class="w-full text-center text-xl pt-5">{{ $text }}</p>

    <form action="{{ route($route,['book' => $book]) }}" method="post" class="text-center">
        @csrf
        @method('patch')
        <x-primary-button class="mt-4">Confirmer</x-primary-button>
    </form>

</div>
