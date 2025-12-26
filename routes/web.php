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


// ==================== ROUTES PUBLIQUES ====================
Route::get('/', [HomeController::class, 'home'])->name('home');

// ==================== ROUTES AUTH ====================
require __DIR__ . '/auth.php';
// ==================== ROUTES ADMIN (role = 1) ====================
Route::middleware(['auth', ])->group(function () {
    Route::get('/home-auth', [AdminController::class, 'dashboard'])->name('home.auth');

    Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
    Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
    Route::get('/langues', [LangueController::class, 'index'])->name('langues.index');

    // Profil admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== ROUTES UTILISATEUR (role = 2) ====================
Route::middleware(['auth', ])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/contenus/{contenu}', [ContenuController::class, 'show'])->name('contenus.show');

    // Commentaires
    Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');

    // Paiement FedaPay
    Route::post('/paiement/initier', [PaiementController::class, 'initier'])->name('paiement.initier');
    Route::get('/paiement/callback', [PaiementController::class, 'callback'])->name('paiement.callback');
    Route::get('/abonnement', [PaiementController::class, 'abonnement'])->name('abonnement.index');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==================== ROUTES CONNECTÉES ====================


// ==================== ROUTES ADMIN ====================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/statsboard', [StatsboardController::class, 'index'])->name('statsboard');

    // Routes CRUD admin
    // Routes CRUD admin (sauf show qui est accessible aux utilisateurs)
    Route::resource('contenus', ContenuController::class)->except(['index', 'show']);
    Route::resource('regions', RegionController::class)->except(['index']);
    Route::resource('langues', LangueController::class)->except(['index']);
    Route::resource('users', UserController::class);
    Route::resource('medias', MediaController::class);
    Route::resource('commentaires', CommentaireController::class)->except(['store']);
});

// ==================== REDIRECTION ====================
Route::get('/setup-seeds-secret', function () {
    try {
        // On lance le seeder en forçant l'exécution (car on est en prod)
        Artisan::call('db:seed', ['--force' => true]);
        
        return 'Succès ! La base de données a été remplie.';
    } catch (\Exception $e) {
        return 'Erreur : ' . $e->getMessage();
    }
});