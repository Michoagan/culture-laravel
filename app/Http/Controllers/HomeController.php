<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Page d'accueil PUBLIQUE (layout guest)
     */
    public function home()
    {
        $stats = $this->getCachedStats();
        $latestContents = $this->getLatestContents();

        return view('home-public', compact('stats', 'latestContents'));
    }

    /**
     * Page d'accueil CONNECTÉE (layout app)
     */
 public function index()
{
    // Récupérer les statistiques (avec cache pour améliorer les performances)
    $stats = $this->getCachedStats();

    // Récupérer les derniers contenus publiés
    $latestContents = $this->getLatestContents();

    return view('home-auth', compact('stats', 'latestContents'));
}

/**
 * Récupérer les statistiques avec cache
 */
private function getCachedStats()
{
    // Cache les statistiques pendant 10 minutes
    return Cache::remember('dashboard_stats', 600, function () {
        return [
            'contenus' => Contenu::where('statut', 'publié')->count(),
            'regions' => Region::count(),
            'langues' => Langue::count(),
            'utilisateurs' => User::where('statut', 'actif')->count(),
        ];
    });
}

/**
 * Récupérer les derniers contenus publiés
 */
private function getLatestContents()
{
    return Contenu::where('statut', 'publié')
        ->with(['typeContenu', 'region', 'langue', 'auteur'])
        ->orderBy('date_creation', 'desc')
        ->take(6)
        ->get();
}

    /**
     * Méthode pour forcer le rafraîchissement du cache (optionnel)
     */
    public function refreshStats()
    {
        Cache::forget('home_stats');
        Cache::forget('latest_contents');

        return redirect()->route('home.auth')->with('success', 'Statistiques rafraîchies !');
    }
}
