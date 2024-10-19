<?php

use App\Models\Author;
use App\Models\Editor;
use App\Models\Language;
use App\Models\Categorie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {

            $table->unsignedTinyInteger('category_id');
            $table->unsignedTinyInteger('language_id');
            $table->unsignedSmallInteger('publishing_id');


            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('publishing_id')->references('id')->on('publishings');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
    
        });
    }
};
