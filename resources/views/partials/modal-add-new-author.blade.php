@php
    $name ?? '';
    $slug ?? '';
@endphp

<div id="{{$name}}Modal" class="modal authorCreateUpdate">

    <p class="w-full text-center text-xl pt-5 pb-8">Ajouter un auteur</p>

    <form method="post" id="{{$name}}" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="grid grid-cols-2">
            <div class = 'mb-4'>
                <label for="picture" class='block font-medium text-sm text-black/80'>Photo de l'auteur</label>
                <input type="file" name="{{$slug}}picture" id="{{$slug}}picture" required
                    class='border-x-0 border-t-0 border-gray-500 w-full h-12 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md '
                    value="{{ old('picture') }}" />
                <div class='error text-red-600'></div>
            </div>
    
            <div class = 'mb-4'>
                <label for="name" class='block font-medium text-sm text-black/80'>Nom de l'auteur</label>
                <input type="text" name="{{$slug}}name" id="{{$slug}}name" required
                    class='border-x-0 border-t-0 border-gray-500 w-full h-12 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md '
                    value="{{ old('name') }}" />
                <div class='error text-red-600'></div>
            </div>
        </div>

        <div class = 'mb-4'>
            <label for="about" class='block font-medium text-sm text-black/80'>A propos de l'auteur</label>
            <textarea required id="{{$slug}}about" name="{{$slug}}about"
                class='border-x-0 border-t-0 border-gray-500 w-full min-h-40 max-h-40 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md'>{{ old('about') }}</textarea>
            <div class='error text-red-600'></div>
        </div>

        <x-primary-button class="mt-4">Valider</x-primary-button>

    </form>

</div>
