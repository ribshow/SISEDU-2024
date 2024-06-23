<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckProf;

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

Route::get('/', function () {
    return view('dashboard');
});

Route::post('/inserir', [UserController::class, 'store'])
    ->middleware(CheckProf::class)
    ->name('store');

Route::get('/lancar', [UserController::class, 'notas'])
    ->middleware(CheckProf::class)
    ->name('lancar');

Route::get('alunos', [UserController::class, 'alunos'])
    ->middleware(CheckProf::class)
    ->name('alunos');

    Route::get('/editar/{id}', [UserController::class, 'view_user'])
    ->middleware(CheckProf::class)
    ->name('editar');

    Route::patch('/editar/{id}', [UserController::class, 'edit_user'])
    ->middleware(CheckProf::class)
    ->name('edit_user');

    Route::delete('/delete/{id}', [UserController::class, 'delete'])
    ->middleware(CheckProf::class)
    ->name('delete');

    Route::get('/editarNota/{id}', [UserController::class, 'editNotas'])
    ->middleware(CheckProf::class)
    ->name('viewNota');

    Route::post('/editarNota', [UserController::class, 'storeNotas'])
    ->middleware(CheckProf::class)
    ->name('editNota');

    Route::delete('/deleteNota/{id}', [UserController::class, 'destroyNota'])
    ->middleware(CheckProf::class)
    ->name('deleteN');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/listNotas', [UserController::class, 'listNotas'])->name('listNotas');
});

Route::get('cadastrar', [AdmController::class, 'cadastro'])
    ->middleware(CheckAdmin::class)
    ->name('cadastrar');

Route::post('criar', [AdmController::class, 'createAluno'])
    ->middleware(CheckAdmin::class)
    ->name('criar');

Route::post('criar_prof', [AdmController::class, 'createProfessor'])
    ->middleware(CheckAdmin::class)
    ->name('criar_prof');

require __DIR__.'/auth.php';
