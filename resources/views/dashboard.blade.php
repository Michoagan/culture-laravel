@extends('layouts.appy')

@section('title', 'Tableau de Bord - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header du Dashboard -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Bonjour, <span class="text-benin-green">{{ Auth::user()->prenom }} !</span>
                    </h1>
                    <p class="text-gray-600">Bienvenue sur votre espace personnel</p>
                </div>
                <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                    @if($stats['abonnement_valide'])
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            Abonné jusqu'au {{ Auth::user()->date_expiration_abonnement->format('d/m/Y') }}
                        </span>
                    @else
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                            Non abonné
                        </span>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="text-benin-green hover:text-benin-dark-green">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Grille principale -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne de gauche -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Section de bienvenue -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Votre activité récente</h2>
                        <a href="{{ route('contenus.index') }}" class="text-benin-green text-sm font-medium hover:underline">
                            Voir tout
                        </a>
                    </div>

                    <!-- Statistiques rapides -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-benin-green mb-1">{{ $stats['contenus_lus'] }}</div>
                            <div class="text-sm text-gray-600">Contenus lus</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-benin-yellow mb-1">{{ $stats['commentaires'] }}</div>
                            <div class="text-sm text-gray-600">Commentaires</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-benin-red mb-1">{{ $stats['favoris'] }}</div>
                            <div class="text-sm text-gray-600">Favoris</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold {{ $stats['abonnement_valide'] ? 'text-green-600' : 'text-red-600' }} mb-1">
                                {{ $stats['jours_restants'] }}
                            </div>
                            <div class="text-sm text-gray-600">Jours restants</div>
                        </div>
                    </div>

                    <!-- Barre de recherche rapide -->
                    <div class="relative">
                        <input type="text"
                               placeholder="Rechercher un contenu culturel..."
                               class="w-full px-4 py-3 pl-12 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent">
                        <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Derniers contenus -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Nouveaux contenus</h2>
                    <div class="space-y-4">
                        @foreach($latestContents as $content)
                            <div class="flex items-start space-x-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-benin-green/10 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 mb-1">{{ $content->titre }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($content->texte, 100) }}</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span class="flex items-center mr-4">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            </svg>
                                            {{ $content->region->nom_region ?? 'Bénin' }}
                                        </span>
                                        <span>{{ $content->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('contenus.show', $content->id) }}"
                                   class="text-benin-green hover:text-benin-dark-green font-medium text-sm">
                                    Lire
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="space-y-8">
                <!-- Carte profil -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full overflow-hidden bg-gray-100 border-4 border-white shadow">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                     alt="{{ Auth::user()->prenom }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-benin-green flex items-center justify-center text-white text-2xl font-bold">
                                    {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h3>
                        <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Langue préférée</span>
                            <span class="font-medium">{{ Auth::user()->langue->nom_langue ?? 'Français' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Membre depuis</span>
                            <span class="font-medium">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="pt-4 border-t border-gray-200">
                            <a href="{{ route('profile.edit') }}"
                               class="block w-full text-center bg-gray-50 hover:bg-gray-100 text-gray-900 py-2 rounded-lg font-medium transition-colors">
                                Modifier mon profil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Section abonnement -->
                <div class="bg-gradient-to-r from-benin-green to-benin-dark-green rounded-xl shadow-sm p-6 text-white">
                    <h3 class="text-lg font-bold mb-4">Votre abonnement</h3>

                    @if($stats['abonnement_valide'])
                        <div class="mb-6">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">Abonnement actif</span>
                            </div>
                            <p class="text-sm opacity-90 mb-4">
                                Votre abonnement expire dans {{ $stats['jours_restants'] }} jours
                            </p>
                            <div class="relative pt-1">
                                <div class="flex mb-2 items-center justify-between">
                                    <div>
                                        <span class="text-xs font-semibold inline-block text-green-200">
                                            {{ min(100, (($stats['jours_restants'] ?? 0) / 365) * 100) }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-900">
                                    <div style="width: {{ min(100, (($stats['jours_restants'] ?? 0) / 365) * 100) }}%"
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-300"></div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-6">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span class="font-medium">Accès limité</span>
                            </div>
                            <p class="text-sm opacity-90 mb-4">
                                Abonnez-vous pour accéder à tous les contenus premium
                            </p>
                        </div>
                    @endif

                    <a href="{{ route('abonnement.index') }}"
                       class="block w-full text-center bg-white hover:bg-gray-100 text-benin-green py-3 rounded-lg font-bold transition-colors">
                        {{ $stats['abonnement_valide'] ? 'Gérer mon abonnement' : 'S\'abonner maintenant' }}
                    </a>
                </div>

                <!-- Vos commentaires récents -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Vos commentaires récents</h3>
                    <div class="space-y-4">
                        @foreach($myComments as $comment)
                            <div class="border-l-4 border-benin-green pl-4 py-2">
                                <p class="text-sm text-gray-900 mb-1">{{ Str::limit($comment->texte, 80) }}</p>
                                <a href="{{ route('contenus.show', $comment->id_contenu) }}"
                                   class="text-xs text-benin-green hover:underline">
                                    {{ $comment->contenu->titre ?? 'Contenu' }}
                                </a>
                                <div class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Section actions rapides -->
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Actions rapides</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('contenus.index') }}"
                   class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 text-center group transition-colors">
                    <div class="w-12 h-12 mx-auto mb-3 bg-benin-green/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Explorer les contenus</span>
                </a>

                <a href="{{ route('regions.index') }}"
                   class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 text-center group transition-colors">
                    <div class="w-12 h-12 mx-auto mb-3 bg-benin-yellow/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-benin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Découvrir les régions</span>
                </a>

                <a href="{{ route('langues.index') }}"
                   class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 text-center group transition-colors">
                    <div class="w-12 h-12 mx-auto mb-3 bg-benin-red/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-benin-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Apprendre les langues</span>
                </a>

                <a href="{{ route('abonnement.index') }}"
                   class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 text-center group transition-colors">
                    <div class="w-12 h-12 mx-auto mb-3 bg-benin-green/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="font-medium text-gray-900">Gérer l'abonnement</span>
                </a>
            </div>
        </div>
    </main>
</div>

<!-- Script pour les interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au survol
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
            card.style.transition = 'transform 0.3s ease';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Notification pour l'abonnement
    @if(!$stats['abonnement_valide'])
    setTimeout(() => {
        showNotification('Abonnez-vous pour accéder à tous les contenus premium !');
    }, 2000);
    @endif

    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-benin-green text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
});
</script>
@endsection
