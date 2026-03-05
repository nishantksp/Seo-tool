<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Client\WebsiteController ;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index']);

    //admin Website management
    Route::patch('/admin/websites/{id}/restore', [WebsiteController::class, 'restore']);
    Route::resource('admin/websites', \App\Http\Controllers\WebsiteController::class); //handles index, create, store, show, edit, update, destroy

    Route::resource('/admin/backlinks', \App\Http\Controllers\BacklinkController::class);
    Route::resource('/admin/keywords', \App\Http\Controllers\KeywordController::class);
    Route::get('/admin/keywords/{id}/ranking', [\App\Http\Controllers\KeywordRankingController::class, 'create']);
    Route::post('/admin/rankings', [\App\Http\Controllers\KeywordRankingController::class, 'store']);
    Route::resource('/admin/onpage', \App\Http\Controllers\OnpageReportController::class);
    Route::resource('/admin/social', \App\Http\Controllers\SocialPostController::class);

    // Admin Client Management
    Route::get('admin/clients',[AdminClientController::class,'index']);
    Route::get('admin/clients/create',[AdminClientController::class,'create']);
    Route::post('admin/clients',[AdminClientController::class,'store']);
    Route::get('admin/clients/{id}/edit',[AdminClientController::class,'edit']);
    Route::put('admin/clients/{id}',[AdminClientController::class,'update']);
    Route::delete('admin/clients/{id}',[AdminClientController::class,'destroy']);
    // Admin Client Actions
    Route::patch('admin/clients/{id}/deactivate',[AdminClientController::class,'deactivate']);
    Route::patch('admin/clients/{id}/activate',[AdminClientController::class,'activate']);
    Route::patch('admin/clients/{id}/reset-password',[AdminClientController::class,'resetPassword']);
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [ClientDashboard::class, 'index']);
});

Route::middleware(['auth', 'role:client'])->prefix('client')->group(function () {

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

require __DIR__ . '/auth.php';
