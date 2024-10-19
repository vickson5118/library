<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Categorie;
use App\Models\Editor;
use App\Models\Language;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        //Categorie::factory(3)->create();
        //Language::factory(5)->create();
        //Editor::factory(10)->create();
        //Book::factory(15)->create();
        Author::factory(10)->create();
    }
}
