<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\MainController;

// Health check endpoint for Railway
Route::get('/health', function () {
    return response()->json(['status' => 'OK', 'timestamp' => now()]);
});

// Database connection test endpoint for Railway
Route::get('/db-test', function () {
    try {
        \DB::connection()->getPdo();
        return response()->json([
            'status' => 'OK',
            'database' => 'Connected',
            'connection' => config('database.default'),
            'timestamp' => now()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'database' => 'Connection failed',
            'error' => $e->getMessage(),
            'timestamp' => now()
        ], 500);
    }
});

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
