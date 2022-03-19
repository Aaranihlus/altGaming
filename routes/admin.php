<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AltLanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\BadgeController;
use Illuminate\Http\Request;
use App\Models\ItemImage;

Route::get('/admin', [AdminController::class, 'show'])->middleware('admin');

Route::get('/admin/discord', [AdminController::class, 'discord'])->middleware('admin');

// Achievements
Route::get('/admin/achievements', [AdminController::class, 'achievements'])->middleware('admin');
Route::post('/admin/achievement/store', [AchievementController::class, 'store'])->middleware('admin');
Route::get('/admin/achievement/create', [AchievementController::class, 'create'])->middleware('admin');

// Roles
Route::get('/admin/roles', [AdminController::class, 'roles'])->middleware('admin');
Route::post('/admin/role/store', [RoleController::class, 'store'])->middleware('admin');
Route::get('/admin/role/create', [RoleController::class, 'create'])->middleware('admin');

// Users
Route::get('/admin/users', [AdminController::class, 'users'])->middleware('admin');
Route::post('/admin/user/grant', [UserController::class, 'grant'])->middleware('admin');
Route::post('/admin/user/delete', [UserController::class, 'delete'])->middleware('admin');

// Posts
Route::get('/admin/posts', [AdminController::class, 'posts'])->middleware('content_creator');
Route::post('/admin/post/publish', [PostController::class, 'publish'])->middleware('admin');
Route::post('/admin/post/hide', [PostController::class, 'hide'])->middleware('admin');
Route::post('/admin/post/delete', [PostController::class, 'delete'])->middleware('admin');
Route::post('/admin/posts/store', [PostController::class, 'store'])->middleware('admin');
Route::get('/admin/posts/create', [PostController::class, 'create'])->middleware('admin');
Route::get('/admin/posts/edit/{post}', [PostController::class, 'edit'])->middleware('admin');
Route::post('/admin/posts/update/{id}', [PostController::class, 'update'])->middleware('admin');

// Orders
Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware('admin');
Route::get('/admin/order/view/{order:paypal_id}', [OrderController::class, 'view'])->middleware('admin');

// Items
Route::get('/admin/items', [AdminController::class, 'items'])->middleware('admin');
Route::get('/admin/items/all', [AdminController::class, 'all_items'])->middleware('admin');
Route::post('/admin/item/store', [ItemController::class, 'store'])->middleware('admin');
Route::get('/admin/item/create', [ItemController::class, 'create'])->middleware('admin');
Route::get('/admin/item/edit/{item}', [ItemController::class, 'edit'])->middleware('admin');
Route::post('/admin/item/update/{id}', [ItemController::class, 'update'])->middleware('admin');

// Events
Route::get('/admin/events', [AdminController::class, 'events'])->middleware('organiser');
Route::post('/admin/event/store', [EventController::class, 'store'])->middleware('admin');
Route::get('/admin/event/create', [EventController::class, 'create'])->middleware('admin');
Route::get('/admin/event/edit/{event}', [EventController::class, 'edit'])->middleware('admin');
Route::post('/admin/event/update/{id}', [EventController::class, 'update'])->middleware('admin');
Route::get('/admin/event/tickets/{event}', [EventController::class, 'tickets'])->middleware('admin');

// Titles and Badges
Route::get('/admin/titles_badges', [AdminController::class, 'titles_badges'])->middleware('admin');

Route::get('/admin/title/create', [TitleController::class, 'create'])->middleware('admin');
Route::get('/admin/badge/create', [BadgeController::class, 'create'])->middleware('admin');

Route::get('/admin/title/store', [TitleController::class, 'store'])->middleware('admin');
Route::get('/admin/badge/store', [BadgeController::class, 'store'])->middleware('admin');


// Image Related
Route::post('/admin/delete_image', function (Request $request) {
  $image = ItemImage::where('id', $request->id)->get()->first()->delete();
});

Route::post('ckeditor/upload', 'App\Http\Controllers\CKEditorController@store')->name('ckeditor.upload');
