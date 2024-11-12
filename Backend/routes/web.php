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
use App\Http\Livewire\Tags\Tags;
use App\Http\Livewire\Comments\Comments;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Artisan;

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
    Route::get('/profile', Profile::class)->name('profile');

    // views
    Route::middleware(['auth', 'permission:articles.index'])->group(function () {
        Route::get('/articles-list', Articles::class)->name('articles-list');
    });
    Route::middleware(['auth', 'permission:comments.index'])->group(function () {
        Route::get('/comments-list', Comments::class)->name('comments-list');
    });
    Route::middleware(['auth', 'permission:tags.index'])->group(function () {
        Route::get('/tags-list', Tags::class)->name('tags-list');
    });
    Route::middleware(['auth', 'permission:users.index'])->group(function () {
        Route::get('/users-list', Users::class)->name('users-list');
    });
    Route::middleware(['auth', 'permission:categories.index'])->group(function () {
        Route::get('/categories-list', Categories::class)->name('categories-list');
    });

    // dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // controllers
    Route::resource('users', UserController::class)->except(['index', 'show']);
    Route::resource('categories', CategoryController::class)->except(['index', 'show']);
    Route::resource('articles', ArticleController::class)->except(['index']);
    Route::resource('comments', CommentController::class)->except(['index', 'create', 'edit', 'update', 'store']);
    Route::resource('roles', RolePermissionController::class);



    Route::get('/run-artisan-command/{command}', function ($command) {
        // Lista de comandos permitidos
        $allowedCommands = ['migrate', 'db:seed', 'cache:clear', 'storage:link', 'config:cache', 'route:cache', 'view:cache', 'optimize:clear', 'optimize', 'key:generate'];

        if (in_array($command, $allowedCommands)) {
            $output = Artisan::call($command);
            return "Comando ejecutado: " . $output;
        } else {
            return "Comando no permitido.";
        }
    });
});
