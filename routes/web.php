<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\StatsboardController;
use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ==================== ROUTES PUBLIQUES ====================
Route::get('/', [HomeController::class, 'home'])->name('home');

// ==================== ROUTES AUTH ====================
require __DIR__ . '/auth.php';

// ==================== ROUTES CONNECTÉES ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/home-auth', [HomeController::class, 'index'])->name('home.auth');
    Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
    Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
    Route::get('/langues', [LangueController::class, 'index'])->name('langues.index');
     Route::get('/contenus', [UserController::class, 'indexcontenus'])->name('users.index');

    // Détails d'un contenu
    Route::get('/contenus/{id}', [UserController::class, 'showcontenus'])->name('users.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
Route::get('/contenus/create', [ContenuController::class, 'create'])->name('contenus.create');

    // Détails d'un contenu
    Route::get('/contenus/{id}', [ContenuController::class, 'show'])->name('contenus.show');

    // Ajouter un commentaire
    Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');

    // Paiement FedaPay
    Route::post('/paiement/initier', [PaiementController::class, 'initier'])->name('paiement.initier');
    Route::get('/paiement/callback', [PaiementController::class, 'callback'])->name('paiement.callback');
});

// ==================== ROUTES ADMIN ====================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/statsboard', [StatsboardController::class, 'index'])->name('statsboard');

    // Routes CRUD admin
    Route::resource('contenus', ContenuController::class)->except(['index']);
    Route::resource('regions', RegionController::class)->except(['index']);
    Route::resource('langues', LangueController::class)->except(['index']);
    Route::resource('users', UserController::class);
    Route::resource('medias', MediaController::class);
    Route::resource('commentaires', CommentaireController::class);
});

// ==================== REDIRECTION ====================
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->id_role === 1) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home.auth');
})->name('dashboard');
