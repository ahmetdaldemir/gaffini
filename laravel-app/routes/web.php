<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

Route::get('/pages/{key}', [MainController::class, 'page']);



// Sayfa route'ları
Route::get('/pages/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)
                ->where('status', 'published')
                ->firstOrFail();

    return view('pages.show', compact('page'));
})->name('pages.show');
