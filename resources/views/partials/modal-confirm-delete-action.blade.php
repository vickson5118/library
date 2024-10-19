@php
    $name ?? '';
@endphp


<div id="{{$name}}Modal" class="modal">

    <p class="w-full text-center text-lg pt-5" id="modal-texte"></p>

    <form action="" method="post" class="text-center" id="{{$name}}">
        @csrf

        <x-primary-button class="mt-4">Confirmer</x-primary-button>
    </form>

</div>
