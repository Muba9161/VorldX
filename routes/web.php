<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FollowRequestController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuickAccessController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\VaultController;
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
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [ChatController::class, 'users'])->name('chat.users');
    Route::get('/chat/{user}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{user}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    // Route::get('/quick-access', [QuickAccessController::class, 'index'])->name('index');
    Route::post('/quick-access/add', [QuickAccessController::class, 'addToQuickAccess'])->name('add-quick');
    Route::get('/quick-access', [QuickAccessController::class, 'showQuickAccessFolders'])->name('quick-access');
    Route::post('/quick-access/remove', [QuickAccessController::class, 'removeFromQuickAccess']);


    // Route::get('/profile/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::post('/profile/posts/store', [PostController::class, 'store'])->name('posts.store');
});

Route::post('/pusher/auth', [ChatController::class, 'pusherAuth'])->middleware('auth');
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
});

Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/replies', [ReplyController::class, 'store'])->name('replies.store');
});




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
Route::post('/entity/store', [EntityController::class, 'store'])->name('entity.store');
Route::delete('/entity/{id}', [EntityController::class, 'destroy'])->name('entity.destroy');




// Calender Route
Route::get('/calender-main', [CalenderController::class, 'index'])->name('calendar_main');
Route::get('/calender', [CalenderController::class, 'calender'])->name('calender');

// Posts Route
Route::get('/post1', [BasicController::class, 'post1'])->name('post1');
Route::get('/post2', [BasicController::class, 'post2'])->name('post2');


// Coming Route
Route::get('/coming', [BasicController::class, 'coming'])->name('coming');

// FollowList Route

Route::get('/followlist', [BasicController::class, 'followlist'])->name('followlist');

// OrgFollowList

Route::get('/orgfollow', [BasicController::class, 'orgfollow'])->name('orgfollow');
Route::get('/following', [BasicController::class, 'following'])->name('following');

// To view Profile Route

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

// To follow or unfollow routes

Route::get('/profile/{user}/follow', [ProfileController::class, 'follow'])->name('profile.follow');
Route::get('/profile/{user}/unfollow', [ProfileController::class, 'unfollow'])->name('profile.unfollow');


// Vault Middleware and routes

Route::middleware(['auth', 'vault.password'])->get('/vault', [VaultController::class, 'index'])->name('vaults.index');

// Route::middleware(['auth', 'vault.password'])->post('/vault', [VaultController::class, 'store'])->name('vaults.index');
// Ensure the middleware is applied on the route where the vault needs to be accessed
// Route::middleware(['auth', 'vault.password'])->post('/vault', [VaultController::class, 'store'])->name('vaults.index');
Route::post('/vaults/enter', [VaultController::class, 'enterVault'])->name('vaults.enter');
Route::post('/vaults/{parentId?}', [VaultController::class, 'store'])->name('vaults.store');
Route::get('/vaults/{vault}', [VaultController::class, 'show'])->name('vaults.show');
Route::post('/vaults/{vault}/copy', [VaultController::class, 'copy'])->name('vaults.copy');
Route::post('/vaults/{copiedFolderId}/paste', [VaultController::class, 'paste'])->name('vaults.paste');
Route::get('/vaults/{vault}/download', [VaultController::class, 'download'])->name('vaults.download');
Route::delete('/vaults/{vault}', [VaultController::class, 'destroy'])->name('vaults.destroy');
Route::post('/login', [AuthenticatedSessionController::class, 'authenticate'])->name('login.authenticate');



require __DIR__ . '/auth.php';
