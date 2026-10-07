<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/servicios', [ServiceController::class, 'index'])
    ->name('services.index');

Route::get('/servicios/{id}', [ServiceController::class, 'show'])
    ->name('services.show');

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/categoria/{category:slug}', [BlogController::class, 'category'])
    ->name('blog.category');

Route::get('/blog/{post:slug}', [BlogController::class, 'show'])
    ->name('blog.show');

Route::get('/turnos/solicitar', [AppointmentController::class, 'create'])
    ->name('appointments.create');

Route::post('/turnos', [AppointmentController::class, 'store'])
    ->name('appointments.store');

Route::get('/admin/login', [AuthController::class, 'loginForm'])
    ->name('admin.login');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');

Route::post('/admin/login', [AuthController::class, 'loginProcess'])
    ->name('admin.login');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('posts', PostController::class)->except('show');
        Route::resource('services', AdminServiceController::class)->except('show');
    });
