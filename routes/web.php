<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;

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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard','App\Http\Controllers\BlogPostController@index')->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group([
    'prefix' => 'blog-posts',
    'middleware' => ['auth'],
    'controller' => BlogPostController::class
], function(){
    Route::get('/all','index')->name('listPosts');
    Route::delete('/{blogPost}','destroy')->name('deletePost');
    Route::get('/create','create')->name('createPostPage');
    Route::post('/create','store')->name('createPost');
    Route::get('/{blogPost}/edit','edit')->name('updatePostPage');
    Route::put('/{blogPost}/edit','update')->name('updatePost');
    Route::delete('/{blogPost}','destroy')->name('deletePost');
});