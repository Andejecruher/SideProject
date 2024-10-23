<?php
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\Articles\Articles;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageUploadController;


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

Route::redirect('/', '/login');
Route::get('/login', Login::class)->name('login');
Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');

Route::middleware('auth')->group(function () {
    // resources
    Route::post('/upload-image', [ImageUploadController::class, 'store'])->name('upload.image');

    // views
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/users-list', Users::class)->name('users-list');
    Route::get('/categories-list', Categories::class)->name('categories-list');
    Route::get('/articles-list', Articles::class)->name('articles-list');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // controllers
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('articles', ArticleController::class);
});
