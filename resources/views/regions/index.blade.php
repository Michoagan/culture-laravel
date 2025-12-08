@extends('layouts.app')

@section('title', 'Régions du Bénin - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Régions du <span class="text-benin-green">Bénin</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Découvrez la richesse culturelle de chaque région de notre pays
            </p>
        </div>

        <!-- Stats & Actions Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-green">{{ $regions->total() }}</div>
                        <div class="text-sm text-gray-500">Régions</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-yellow">{{ $stats['totalContenus'] ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Contenus</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-red">{{ $stats['languesUniques'] ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Langues</div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('regions.create') }}" 
                       class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg flex items-center justify-center">
                       <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                       </svg>
                       Nouvelle Région
                    </a>
                </div>
            </div>
        </div>

        <!-- Regions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($regions as $index => $region)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift group" 
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($index % 6) * 100 }}">
                
                <!-- Region Header -->
                <div class="benin-gradient px-6 py-8 text-white text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-2">{{ $region->nom_region }}</h3>
                        <div class="flex justify-center space-x-4 text-sm opacity-90">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $region->localisation ?? 'Bénin' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Region Content -->
                <div class="p-6">
                    <!-- Description -->
                    <p class="text-gray-600 mb-6 line-clamp-3">
                        {{ $region->description ?? 'Découvrez la richesse culturelle de cette région.' }}
                    </p>

                    <!-- Statistics -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-xl font-bold text-benin-green">{{ $region->contenus_count ?? 0 }}</div>
                            <div class="text-xs text-gray-500">Contenus</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-benin-yellow">{{ $region->langues_count ?? 0 }}</div>
                            <div class="text-xs text-gray-500">Langues</div>
                        </div>
                    </div>

                    <!-- Population & Superficie -->
                    <div class="space-y-2 text-sm text-gray-500 mb-6">
                        @if($region->population)
                        <div class="flex justify-between">
                            <span>Population</span>
                            <span class="font-medium text-gray-900">{{ number_format($region->population, 0, ',', ' ') }} hab.</span>
                        </div>
                        @endif
                        @if($region->superficie)
                        <div class="flex justify-between">
                            <span>Superficie</span>
                            <span class="font-medium text-gray-900">{{ number_format($region->superficie, 0, ',', ' ') }} km²</span>
                        </div>
                        @endif
                    </div>

                    <!-- Languages -->
@if($region->langue && $region->langue->count() > 0)
<div class="mb-6">
    <h4 class="text-sm font-medium text-gray-900 mb-2">Langues parlées</h4>
    <div class="flex flex-wrap gap-1">
        @foreach($region->langue->take(3) as $langue)
        <span class="bg-benin-green/10 text-benin-green px-2 py-1 rounded text-xs">
            {{ $langue->nom_langue }}
        </span>
        @endforeach
        @if($region->langue->count() > 3)
        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">
            +{{ $region->langue->count() - 3 }}
        </span>
        @endif
    </div>
</div>
@endif

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <a href="{{ route('regions.show', $region) }}" 
                           class="text-benin-green hover:text-benin-dark-green font-medium flex items-center space-x-1 group-hover:translate-x-1 transition-transform duration-300">
                           <span>Explorer</span>
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                           </svg>
                        </a>
                        
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('regions.edit', $region) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-110"
                               title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucune région trouvée</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Commencez par créer la première région pour organiser les contenus culturels.
                </p>
                <a href="{{ route('regions.create') }}" 
                   class="bg-benin-green text-white px-8 py-4 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg inline-flex items-center">
                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                   </svg>
                   Créer la première région
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($regions->hasPages())
        <div class="mt-12" data-aos="fade-up">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                {{ $regions->links() }}
            </div>
        </div>
        @endif

    </div>
</div>

<style>
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