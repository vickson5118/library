@extends('layouts.app')

@section('content')
    <div class="p-4">

        <!-- Section recherche -->
        <div class="w-full bg-gray-300 min-h-52 overflow-hidden shadow-lg mt-4">
            <div class="mt-8 ml-20 text-black mb-5">
                <i class="bi bi-search text-lg"></i>
                <span class="text-lg">Rechercher un livre</span>
            </div>

            <form method="get">
                @csrf
                <div class="grid grid-cols-4 pl-20">
                    <div>
                        <select name="author" id="author"
                                class="w-11/12 border-x-0 border-t-0 border-gray-500 h-12 mb-2 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md">
                            <option value="">Selectionner un auteur</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" @if(isset($input['author']))
                                    @selected($input['author'] == $author->id)
                                    @endif>{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="category" id="category"
                                class="w-11/12 border-x-0 border-t-0 border-gray-500 h-12 mb-2 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md">
                            <option value="">Selectionner une categorie</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if(isset($input['category']))
                                    @selected($input['category'] == $category->id)
                                    @endif>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="text" name="title" id="title" placeholder="Titre du livre"
                               class="w-11/12 border-x-0 border-t-0 border-gray-500 h-12 mt-2 focus:border-[#fe4b40] focus:ring-0 rounded-md"
                               value="{{ $input['title'] ?? '' }}">
                    </div>
                    <div>
                        <x-primary-button class="mt-2">Rechercher</x-primary-button>
                    </div>

                </div>
            </form>
        </div>


        <!-- Liste des livres -->
        <div class="w-full bg-gray-300 overflow-hidden shadow-lg mt-10 p-8 grid grid-cols-7 gap-10">

            @if($count <= 0)
                <div class="col-span-7 text-black/70 text-center ">
                    <p class="text-3xl ">Aucun livre enregistré</p>
                    <p class="text-md">Enregistrez de nouveaux livres et profitez de l'application</p>
                </div>
            @endif

            @foreach ($books as $book)
                <a href="{{ route('book.show', ['book' => $book]) }}" class="h-full shadow-lg p-4 bg-white">
                    <img src="/storage/{{ $book->cover }}" alt="{{ $book->title }}">
                </a>
            @endforeach

        </div>

        <div>
            @if (!isset($input['author']) && !isset($input['category']) && !isset($input['title']))
                {{ $books->links() }}
            @endif
        </div>
        <!--</div>-->

        <script type="module">

        </script>
@endsection
