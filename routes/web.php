<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FollowRequestController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
});



Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::post('/replies', [ReplyController::class, 'store'])->name('replies.store');


Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
Route::get('/folders/create', [FolderController::class, 'create'])->name('folders.create');
// Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');
Route::post('/folders/{parentId?}', [FolderController::class, 'store'])->name('folders.store');
Route::get('/folders/{folder}', [FolderController::class, 'show'])->name('folders.show');
Route::post('/folders/{folder}/copy', [FolderController::class, 'copy'])->name('folders.copy');
Route::post('/folders/{copiedFolderId}/paste', [FolderController::class, 'paste'])->name('folders.paste');
Route::get('/folders/{folder}/download', [FolderController::class, 'download'])->name('folders.download');
Route::delete('/folders/{folder}', [FolderController::class, 'destroy'])->name('folders.destroy');

// Entity Route
Route::get('/entity', [EntityController::class, 'index'])->name('entity.index');
Route::get('/entity/create', [EntityController::class, 'create'])->name('entity.create');
// Route::post('/entity', [EntityController::class, 'store'])->name('entity.store');
Route::post('/entity/{parentId?}', [EntityController::class, 'store'])->name('entity.store');
Route::get('/entity/{entity}', [EntityController::class, 'show'])->name('entity.show');
Route::post('/entity/{entity}/copy', [EntityController::class, 'copy'])->name('entity.copy');
Route::delete('/entity/{entity}', [EntityController::class, 'destroy'])->name('entity.destroy');


// Company Follow
Route::post('/follow/{organization}', [FollowRequestController::class, 'follow'])->name('follow');

// Organization routes to manage followers
Route::get('/organization/{organization}/followers', [OrganizationController::class, 'followers'])->name('organization.followers');
Route::post('/organization/{organization}/accept-follow/{user}', [OrganizationController::class, 'acceptFollow'])->name('organization.acceptFollow');
Route::post('/organization/{organization}/reject-follow/{user}', [OrganizationController::class, 'rejectFollow'])->name('organization.rejectFollow');
Route::get('/search-organizations', [OrganizationController::class, 'search'])->name('organizations.search');

// Calender Route
Route::get('/calender', [CalenderController::class, 'index'])->name('calender');


// Coming Route
Route::get('/coming', [BasicController::class, 'coming'])->name('coming');




require __DIR__ . '/auth.php';
