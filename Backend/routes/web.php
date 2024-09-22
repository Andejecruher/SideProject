<?php

use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users\Users;

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

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::get('/users', Users::class)->name('users');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::group(['prefix' => 'articulos'], function () {
        Route::get('/', [ArticuloController::class, 'index']);
        Route::get('/{id}', [ArticuloController::class, 'show']);
        Route::post('/', [ArticuloController::class, 'store']);
        Route::put('/{id}', [ArticuloController::class, 'update']);
        Route::delete('/{id}', [ArticuloController::class, 'destroy']);
    });

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, 'index']);
        Route::get('/{id}', [TagController::class, 'show']);
        Route::post('/', [TagController::class, 'store']);
        Route::put('/{id}', [TagController::class, 'update']);
        Route::delete('/{id}', [TagController::class, 'destroy']);
    });

    Route::group(['prefix' => 'comentarios'], function () {
        Route::get('/', [ComentarioController::class, 'index']);
        Route::get('/{id}', [ComentarioController::class, 'show']);
        Route::post('/', [ComentarioController::class, 'store']);
        Route::put('/{id}', [ComentarioController::class, 'update']);
        Route::delete('/{id}', [ComentarioController::class, 'destroy']);
    });

    Route::group(['prefix' => 'categorias'], function () {
        Route::get('/', [CategoriaController::class, 'index']);
        Route::get('/{id}', [CategoriaController::class, 'show']);
        Route::post('/', [CategoriaController::class, 'store']);
        Route::put('/{id}', [CategoriaController::class, 'update']);
        Route::delete('/{id}', [CategoriaController::class, 'destroy']);
    });
});
