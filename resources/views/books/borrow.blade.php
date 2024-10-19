@extends('layouts.app')

@section('content')
    <div class="p-10">

        <h1 class="text-2xl text-center"> Les livres empruntés</h1>

        <!-- Liste des livres -->
        <div class="w-full bg-gray-300 overflow-hidden shadow-lg mt-10 p-8 grid grid-cols-6 gap-10">

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
    </div>
@endsection
