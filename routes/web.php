<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShowPosts;
use App\Http\Livewire\CategoryPosts;
use App\Http\Livewire\Detail;
use App\Http\Livewire\Dashboard\NewPost as AdminNewPost;
use App\Http\Livewire\NewPost as NewPost;
use App\Http\Livewire\Dashboard\EditPost as AdminEditPost;
use App\Http\Livewire\EditPost as EditPost;
use App\Http\Livewire\Dashboard\FeaturedImageUpload;
use App\Http\Livewire\DeleteCommentReason;
use App\Http\Livewire\DeletePostReason;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ShowPosts::class)->name('home');

Route::get('post-detail/{id}', Detail::class)->name('post-detail');

Route::get('categories/{category}', CategoryPosts::class)->name('category');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('post/add', NewPost::class)->name('new-post-front');
    Route::get('post/edit/{id}', EditPost::class)->name('edit-post-front');
    Route::get('commentdeletereason/{id}', DeleteCommentReason::class)->name('add-comment-deleted-reason');
    Route::get('postdeletereason/{id}', DeletePostReason::class)->name('add-post-deleted-reason');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('post/add', AdminNewPost::class)->name('new-post');

    Route::get('post/edit/{id}', AdminEditPost::class)->name('edit-post');

});
