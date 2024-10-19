<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublishingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/users')->name('user.')->controller(UserController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::post('/delete','delete')->name('delete');
    Route::post('/update','update')->name('update');
});

Route::prefix('/languages')->name('language.')->controller(LanguageController::class)->group(function(){

    Route::get('/','index')->name('index');
    Route::post('/create','store')->name('store');
    Route::post('/update','update')->name('update');
    Route::post('/delete','delete')->name('delete');

});

Route::prefix('/publishings')->name('publishing.')->controller(PublishingController::class)->group(function(){

    Route::get('/','index')->name('index');
    Route::post('/create','store')->name('store');
    Route::post('/update','update')->name('update');
    Route::post('/delete','delete')->name('delete');
    
});

Route::prefix('/authors')->name('author.')->controller(AuthorController::class)->group(function(){

    Route::post('/delete','destroy')->name('delete');
    Route::get('/','index')->name('index');
    Route::post('/create','store')->name('store');
    Route::post('/update','update')->name('update');
   

});

Route::prefix('/categories')->name('category.')->controller(CategoryController::class)->group(function(){

    Route::get('/','index')->name('index');
    Route::post('/create','store')->name('store');
    Route::post('/update','update')->name('update');
    Route::post('/delete','delete')->name('delete');

});

Route::get('/', [BookController::class, 'index'])->name('app.index');

Route::prefix('/books')->name('book.')->controller(BookController::class)->group(function(){
    
    Route::get('/create','create')->name('create')->middleware('auth');
    Route::post('/create','store')->name('store')->middleware('auth');
    Route::get('/borrows','borrowIndex')->name('index.borrow');
    Route::get('/{book:slug}','show')->name('show');
    Route::get('/edit/{book:slug}','edit')->name('edit')->middleware('auth');
    Route::patch('/edit/{book:slug}','update')->name('update')->middleware('auth');
    Route::patch('/borrow/{book:slug}','borrow')->name('borrow')->middleware('auth');
    Route::patch('/back/{book:slug}','back')->name('back')->middleware('auth');
    
});



require __DIR__.'/auth.php';
