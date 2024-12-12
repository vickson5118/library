<div id="{{$name}}Modal" class="modal">

    <p class="w-full text-center text-xl pt-5">{{ $modalText }}</p>

    <form action="" method="post" id="{{$name}}" class="relative" novalidate>
        @csrf

        <div class = 'mb-4 relative'>
            <label for="{{$slug}}title" class='block font-medium text-sm text-black/80'> </label>

            <input type="text" name="{{$slug}}title" id="{{$slug}}title" required
                class='border-x-0 border-t-0 border-gray-500 w-full h-12 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md '
                value="{{ old($name.'-title') }}" />

            <div class='error text-red-600'></div>
        </div>

        <x-primary-button class="mt-4 text-center">Valider</x-primary-button>

    </form>

</div>
