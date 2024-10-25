@extends('layouts.app')

@section('content')
    <div class="p-10">

        <h1 class="text-2xl text-center"> Les livres empruntés</h1>

        <!-- Liste des livres -->
        <div class="w-full bg-gray-300 overflow-hidden shadow-lg mt-10 p-8 grid grid-cols-6 gap-10">

            @if($count <= 0)
                <div class="col-span-7 text-black/70 text-center ">
                    <p class="text-3xl ">Aucun livre emprunté pour le moment</p>
                    <p class="text-md">Retrouvez la liste des livres empruntés dans cette section</p>
                </div>
            @endif

            @foreach ($borrows as $book)
                <a href="{{ route('book.show', ['book' => $book]) }}" class="h-full shadow-lg p-4 bg-white">
                    <img src="/storage/{{ $book->cover }}" alt="{{ $book->title }}">
                </a>
            @endforeach

        </div>

        <div>

            {{ $borrows->links() }}
        </div>
    </div>
@endsection
