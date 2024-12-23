<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{lang?}', [MainController::class, 'home'])->where('lang', 'ru|en|uz')->name('home');
Route::get('/{lang}/menu-{id}/{slug}', [MainController::class, 'postpage'])->where('lang', 'ru|en|uz')->name('postpage');

Route::get('/{lang}/site-map', [MainController::class, 'sitemap'])->where('lang', 'ru|en|uz');

Route::get('/{lang}/posts-{type}', [PostController::class, 'blogPosts'])->where('lang', 'ru|en|uz')->name('blogPosts');
Route::get('/{lang}/posts-{type}/{slug}', [PostController::class, 'blogPost'])->where('lang', 'ru|en|uz')->name('blogPost');

Route::get('/{lang}/posts', [PostController::class, 'posts'])->where('lang', 'ru|en|uz')->name('posts');
Route::get('/{lang}/posts/{slug}', [PostController::class, 'post'])->where('lang', 'ru|en|uz')->name('post');

Route::get('/{lang}/reviews', [MainController::class, 'reviews'])->where('lang', 'ru|en|uz')->name('reviews');
Route::get('/{lang}/reviews/{slug}', [MainController::class, 'review'])->where('lang', 'ru|en|uz')->name('review');

Route::get('/{lang}/employees', [MainController::class, 'staffs'])->where('lang', 'ru|en|uz')->name('staffs');
Route::get('/{lang}/employees/{slug}', [MainController::class, 'staff'])->where('lang', 'ru|en|uz')->name('staff');

Route::get('/{lang}/home/contact', [ContactController::class, 'index'])->where('lang', 'ru|en|uz')->name('contact');
Route::post('/{lang}/submit', [ContactController::class, 'submit'])->where('lang', 'ru|en|uz')->name('form.submit');

Route::get('/{lang}/product/{slug}', [ProductController::class, 'product'])->where('lang', 'ru|en|uz');
Route::get('/{lang}/products/{slug}', [ProductController::class, 'products'])->where('lang', 'ru|en|uz');
Route::get('/{lang}/products-catalog', [ProductController::class, 'productCategory'])->where('lang', 'ru|en|uz');

Route::get('/{lang}/photo-gallery', [MainController::class, 'gallery'])->where('lang', 'ru|en|uz');
Route::get('/{lang}/photo-gallery/{slug}', [MainController::class, 'photo'])->where('lang', 'ru|en|uz');

Route::get('/{lang}/video', [MainController::class, 'video'])->where('lang', 'ru|en|uz');

// search routes
Route::get('/search/{query}', [MainController::class, 'search'])->name('search');


Route::get('/{lang}', function ($lang){
    session()->put(['lang' => $lang]);
    return back();
})->where('lang', 'ru|en|uz');