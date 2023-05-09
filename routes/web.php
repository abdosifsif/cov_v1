<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrajetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeaheadController;
use App\Http\Controllers\MessagesController;

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
    return view('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/recherche', function () {
    return view('Recherche');
});
Route::post('/recherche', [TrajetController::class, 'search'])->name('recherche');

Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);


Route::middleware('auth')->group(function () {
Route::get('/messages', [MessagesController::class, 'create']);

Route::post('/ajouter-trajet', [TrajetController::class, 'store'])->name('trajet.store');
Route::get('/ajouter-trajet', [TrajetController::class, 'create'])->name('trajet.create');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/register', [TypeaheadController::class, 'myControllerMethod'])->name('register');

