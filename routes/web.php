<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\OperatorUserController;

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

Route::get('/', [Controller::class, 'home']);

Route::get('/about', [Controller::class, 'about']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', [Controller::class, 'categories']);
Route::get('/movies', [Controller::class, 'movies'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware('auth');

Route::get('dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin');

Route::get('dashboard/users/checkSlug', [OperatorUserController::class, 'checkSlug'])->middleware('admin');
Route::resource('/dashboard/users', OperatorUserController::class)->middleware('operator');






// 2 routes dibawah tidak terpakai lagi, karena udah di kelola di Models (Post) yg lebih kompleks (method when)

// Route::get('/categories/{category:slug}', function(Category $category) {
//     return view('posts', [
//         'title' => "Post Category : $category->name",
//         "active" => 'categories',
//         'posts' => $category->posts->load('category','author'),
//     ]);
// });

// Route::get('/authors/{author:username}', function(User $author) {
//     return view('posts', [
//         'title' => "Author By : $author->name",
//         "active" => 'posts',
//         'posts' => $author->posts->load('category','author'),
//     ]);
// });
