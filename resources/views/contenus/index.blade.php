@extends('layouts.app')

@section('title', 'Tous les Contenus Culturels - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Contenus <span class="text-benin-green">Culturels</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Découvrez l'ensemble des histoires, recettes et traditions du Bénin
            </p>
        </div>

        <!-- Stats & Actions Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-green">{{ $contenus->total() }}</div>
                        <div class="text-sm text-gray-500">Contenus</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-yellow">{{ $stats['publies'] ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Publiés</div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('contenus.create') }}" 
                       class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg flex items-center justify-center">
                       <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                       </svg>
                       Nouveau Contenu
                    </a>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <input type="text" 
                           placeholder="Rechercher un contenu..." 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                </div>
                
                <!-- Type Filter -->
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                    <option value="">Tous les types</option>
                    @foreach($typesContenu as $type)
                    <option value="{{ $type->id }}">{{ $type->nom }}</option>
                    @endforeach
                </select>
                
                <!-- Region Filter -->
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                    <option value="">Toutes les régions</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->nom_region }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Contenus Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($contenus as $index => $contenu)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift group" 
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($index % 6) * 100 }}">
                
                <!-- Status Badge -->
                <div class="absolute top-4 right-4 z-10">
                    @switch($contenu->statut)
                        @case('publié')
                            <span class="bg-benin-green text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                Publié
                            </span>
                            @break
                        @case('brouillon')
                            <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                Brouillon
                            </span>
                            @break
                        @case('en_attente')
                            <span class="bg-benin-yellow text-gray-900 px-3 py-1 rounded-full text-sm font-medium shadow-lg">
                                En attente
                            </span>
                            @break
                    @endswitch
                </div>

                <!-- Content Card -->
                <div class="p-6">
                    <!-- Type & Date -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-benin-green/10 text-benin-green px-3 py-1 rounded-full text-sm font-medium">
                            {{ $contenu->typeContenu->nom ?? 'Culture' }}
                        </span>
                        <span class="text-sm text-gray-500">{{ $contenu->created_at->format('d/m/Y') }}</span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-benin-green transition-colors duration-300">
                        {{ $contenu->titre }}
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($contenu->texte, 120) }}
                    </p>

                    <!-- Metadata -->
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <div class="flex items-center space-x-4">
                            <!-- Author -->
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $contenu->auteur->prenom ?? 'Anonyme' }}
                            </span>
                            
                            <!-- Region -->
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $contenu->region->nom_region ?? 'Bénin' }}
                            </span>
                        </div>
                    </div>

                    <!-- Language & Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <!-- Language -->
                        <span class="bg-benin-yellow/10 text-benin-yellow px-2 py-1 rounded text-xs font-medium">
                            {{ $contenu->langue->nom_langue ?? 'Multilingue' }}
                        </span>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('contenus.show', $contenu) }}" 
                               class="text-benin-green hover:text-benin-dark-green transition-colors duration-300 transform hover:scale-110"
                               title="Voir le contenu">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            
                            <a href="{{ route('contenus.edit', $contenu) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-110"
                               title="Modifier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="col-span-full text-center py-16" data-aos="fade-up">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun contenu trouvé</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Commencez par créer le premier contenu culturel pour enrichir notre plateforme.
                </p>
                <a href="{{ route('contenus.create') }}" 
                   class="bg-benin-green text-white px-8 py-4 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg inline-flex items-center">
                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                   </svg>
                   Créer le premier contenu
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($contenus->hasPages())
        <div class="mt-12" data-aos="fade-up">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                {{ $contenus->links() }}
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection