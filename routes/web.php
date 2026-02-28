<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index']);

Route::resource('admin/websites', \App\Http\Controllers\WebsiteController::class);
Route::resource('/admin/backlinks', \App\Http\Controllers\BacklinkController::class);
Route::resource('/admin/keywords', \App\Http\Controllers\KeywordController::class);
Route::get('/admin/keywords/{id}/ranking', [\App\Http\Controllers\KeywordRankingController::class, 'create']);
Route::post('/admin/rankings', [\App\Http\Controllers\KeywordRankingController::class, 'store']);
Route::resource('/admin/onpage', \App\Http\Controllers\OnpageReportController::class);
Route::resource('/admin/social', \App\Http\Controllers\SocialPostController::class);
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [ClientDashboard::class, 'index']);
});

Route::middleware(['auth','role:client'])->prefix('client')->group(function () {

    Route::get('/dashboard', [ClientDashboard::class, 'index']);

    Route::get('/websites', [\App\Http\Controllers\Client\WebsiteController::class, 'index']);
    Route::get('/keywords', [\App\Http\Controllers\Client\KeywordController::class, 'index']);
    Route::get('/backlinks', [\App\Http\Controllers\Client\BacklinkController::class, 'index']);
    Route::get('/onpage', [\App\Http\Controllers\Client\OnpageController::class, 'index']);
   Route::get('/blogs', [\App\Http\Controllers\Client\BlogController::class, 'index']);
Route::get('/blogs/create', [\App\Http\Controllers\Client\BlogController::class, 'create']);
Route::post('/blogs', [\App\Http\Controllers\Client\BlogController::class, 'store']);
    Route::get('/social', [\App\Http\Controllers\Client\SocialController::class, 'index']);
Route::get('/social/create', [\App\Http\Controllers\Client\SocialController::class, 'create']);
Route::post('/social', [\App\Http\Controllers\Client\SocialController::class, 'store']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


