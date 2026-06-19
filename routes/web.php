<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Roles
    Route::prefix('roles')->group(function () {

        Route::get('/', [RoleController::class, 'index'])
            ->name('roles.index');

        Route::get('/listar', [RoleController::class, 'listar'])
            ->name('roles.listar');

        Route::get('/crear', [RoleController::class, 'create'])
            ->name('roles.create');

        Route::post('/guardar', [RoleController::class, 'store'])
            ->name('roles.store');


        Route::get('/desactivados', [RoleController::class, 'desactivados'])
            ->name('roles.desactivados');

    });

});

require __DIR__.'/auth.php';