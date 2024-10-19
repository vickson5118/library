@extends('layouts.app')

@section('content')
    <div class="p-10 flex bg-gray-300 rounded-md mx-20 mt-10 shadow-md">

        @auth
            @if ($book->borrow)
                @if ($borrow != null)
                    <button id="back_book" type="button"
                        class="text-white py-2 px-5 bg-red-500 rounded-xl absolute right-36 t-5 font-bold">Indisponible</button>
                @endif
            @else
                <button id="borrow_book" type="button"
                    class="text-white py-2 px-5 bg-green-500 rounded-xl absolute right-40 t-5 font-bold">Disponible</button>
            @endif

            @can('update', $book)
                <a href="{{ route('book.edit', ['book' => $book]) }}"
                    class="text-white decoration-white no-underline py-2 px-5 bg-blue-500 rounded-xl absolute right-72 t-5 font-bold inline-block">Modifier</a>
            @endcan
        @endauth

        <div class="p-10">
            <img src="/storage/{{ $book->cover }}" alt="" class="w-64 min-w-64 max-w-64">
        </div>
        <div class="w-full">
            <div class="px-10 pt-10 pb-4">
                <h1 class="font-bold text-3xl">{{ $book->title }}</h1>
                <div> <span class="font-bold underline">Auteur(s)</span> :
                    @foreach ($book->authors as $author)
                        @if ($loop->last)
                            <span>{{ $author->name }}</span>
                        @else
                            <span>{{ $author->name }}</span>,
                        @endif
                    @endforeach
                </div>
                @if ($book->borrow)
                    <div class="text-red-500">
                        <span class="font-bold underline">Emprunté par</span> : {{ $borrows->last()->user->name }}, le
                        {{ date('d/m/Y', strtotime($borrows->last()->created_at)) }}
                    </div>
                @endif
                <p class="py-4 text-justify">{{ $book->summary }}</p>
                <hr>
            </div>
            <div class="grid grid-cols-4 px-10">
                <div class="text-center">
                    <p class="mb-2">Langue</p>
                    <i class="bi bi-translate text-3xl"></i>
                    <p class="pt-2">{{ $book->language->title }}</p>
                </div>

                <div class="text-center">
                    <p class="mb-2">Editeur</p>
                    <i class="bi bi-buildings-fill text-3xl"></i>
                    <p class="pt-2">{{ $book->publishing->title }}</p>
                </div>

                <div class="text-center">
                    <p class="mb-2">Nombres de pages</p>
                    <i class="bi bi-journals text-3xl"></i>
                    <p class="pt-2">{{ $book->page }}</p>
                </div>

                <div class="text-center">
                    <p class="mb-2">Date de publication</p>
                    <i class="bi bi-calendar3 text-3xl"></i>
                    <p class="pt-2">{{ date('d/m/Y', strtotime($book->publication)) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des auteurs -->
    <div class="p-10 bg-gray-300 rounded-md mx-20 mt-10 shadow-md">
        <p class="text-3xl font-bold w-full mb-10">A propos de l'auteur</p>

        @foreach ($book->authors as $author)
            <div class="flex mb-5 items-center">

                @if ($author->picture != null)
                    <img src="/storage/{{ $author->picture }}" alt="{{ $author->name }}"
                        class="min-w-32 min-h-32 max-w-32 max-h-32 rounded-full inline-block">
                @else
                    <div
                        class="min-w-32 min-h-32 max-w-32 max-h-32 rounded-full inline-block bg-white text-6xl font-bold pt-8 pl-6">
                        SK</div>
                @endif

                <div class="ml-8">
                    <p class="text-xl font-bold text-[#596643]">{{ $author->name }}</p>
                    <p class="text-justify pr-24">{{ $author->about }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Liste des emprunts -->
    <div class="p-10 bg-gray-300 rounded-md mx-20 mt-10 shadow-md">
        <p class="text-3xl font-bold w-full mb-10">Les emprunts</p>
        <div class="mx-auto min-w-full">
            <table class="table-layout: auto; min-w-full">
                <thead class="w-full">
                    <tr class="border-2 h-16">
                        <th class="w-2/12 text-center border-r-2">N°</th>
                        <th class="w-6/12 text-center border-r-2">Nom de l'emprunteur</th>
                        <th class="w-2/12 text-center border-r-2">Date d'emprunt</th>
                        <th class="w-2/12 text-center border-r-2">Date de retour</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrows as $borrow)
                        <tr class="h-14 border-2">
                            <td class="text-center border-r-2"> {{ $loop->iteration }} </td>
                            <td class="text-center border-r-2">{{ $borrow->user->name }} </td>
                            <td class="border-r-2 p-3 text-center"> {{ date('d/m/Y', strtotime($borrow->created_at)) }}
                            </td>
                            <td class="text-center">
                                @if ($borrow->back == null)
                                    <span class="text-red-700">En cours</span>
                                @else
                                    {{ date('d/m/Y', strtotime($borrow->back)) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('partials.modal-confirm-action-borrow', [
        'name' => 'borrowBook',
        'text' => 'Etes-vous sûr(e) de vouloir emprunter ce livre ?',
        'route' => 'book.borrow',
    ])
    @include('partials.modal-confirm-action-borrow', [
        'name' => 'backBook',
        'text' => 'Etes-vous sûr(e) de vouloir retourner ce livre ?',
        'route' => 'book.back',
    ])

    <script type="module">
        $(document).ready(function() {

            $('#borrow_book').on('click', function() {
                $('#borrowBookModal').modal()
            })

            $('#back_book').on('click', function() {
                $('#backBookModal').modal()
            })

        })
    </script>
@endsection
