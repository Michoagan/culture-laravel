@extends('layouts.app')

@section('title', $region->nom_region . ' - Culture Bénin')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="benin-gradient text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <!-- Floating elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white/10 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/3 right-1/4 w-16 h-16 bg-white/10 rounded-full animate-pulse-slow"></div>
        
        <div class="relative z-10 max-w-6xl mx-auto px-4 text-center">
            <!-- Region Badge -->
            <div class="inline-block bg-white/20 backdrop-blur-sm rounded-2xl px-6 py-3 mb-6" data-aos="fade-down">
                <span class="text-sm font-medium">Région du Bénin</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-glow" data-aos="fade-up">
                {{ $region->nom_region }}
            </h1>
            
            <!-- Description -->
            @if($region->description)
            <p class="text-xl mb-8 max-w-2xl mx-auto text-gray-200 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                {{ $region->description }}
            </p>
            @endif
            
            <!-- Metadata -->
            <div class="flex flex-wrap justify-center items-center gap-6 text-sm" data-aos="fade-up" data-aos-delay="200">
                <!-- Contents Count -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ $region->contenus_count }} contenu(s) culturel(s)</span>
                </div>
                
                <!-- Languages -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                    <span>{{ $region->langues_count }} langue(s) parlée(s)</span>
                </div>
                
                <!-- Population -->
                @if($region->population)
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>{{ number_format($region->population, 0, ',', ' ') }} habitants</span>
                </div>
                @endif
                
                <!-- Superficie -->
                @if($region->superficie)
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ number_format($region->superficie, 0, ',', ' ') }} km²</span>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Languages Section -->
                @if($region->langues->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                        Langues parlées dans la région
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($region->langues as $langue)
                        <div class="bg-gray-50 rounded-lg p-4 hover-lift group">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-benin-green/10 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-benin-green font-bold text-sm">{{ strtoupper(substr($langue->code_langue, 0, 2)) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $langue->nom_langue }}</h3>
                                    <p class="text-sm text-gray-600">{{ $langue->code_langue }}</p>
                                </div>
                            </div>
                            @if($langue->description)
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $langue->description }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Contenus Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9m0 0v2m0-2a2 2 0 012-2h2a2 2 0 012 2m0 0V7a2 2 0 012-2h2a2 2 0 012 2v1"/>
                            </svg>
                            Contenus culturels ({{ $contenus->total() }})
                        </h2>
                        
                        <!-- Filters -->
                        <div class="flex space-x-4 mt-4 sm:mt-0">
                            <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent text-sm transition-all duration-300">
                                <option value="">Tous les types</option>
                                @foreach($typesContenu as $type)
                                <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                @endforeach
                            </select>
                            
                            <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent text-sm transition-all duration-300">
                                <option value="newest">Plus récents</option>
                                <option value="oldest">Plus anciens</option>
                                <option value="popular">Plus populaires</option>
                            </select>
                        </div>
                    </div>

                    @if($contenus->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($contenus as $index => $contenu)
                        <div class="bg-gray-50 rounded-xl p-6 hover-lift group" 
                             data-aos="fade-up" 
                             data-aos-delay="{{ ($index % 4) * 100 }}">
                            
                            <!-- Type & Status -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="bg-benin-green/10 text-benin-green px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $contenu->typeContenu->nom ?? 'Culture' }}
                                </span>
                                <span class="text-sm text-gray-500">{{ $contenu->created_at->format('d/m/Y') }}</span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-benin-green transition-colors duration-300">
                                <a href="{{ route('contenus.show', $contenu) }}">{{ $contenu->titre }}</a>
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit($contenu->texte, 120) }}
                            </p>

                            <!-- Metadata -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-3">
                                    <!-- Author -->
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $contenu->auteur->prenom ?? 'Anonyme' }}
                                    </span>
                                    
                                    <!-- Language -->
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                        </svg>
                                        {{ $contenu->langue->nom_langue ?? 'Multilingue' }}
                                    </span>
                                </div>

                                <!-- Read More -->
                                <a href="{{ route('contenus.show', $contenu) }}" 
                                   class="text-benin-green hover:text-benin-dark-green font-medium flex items-center transition-colors duration-300">
                                   Lire
                                   <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                   </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($contenus->hasPages())
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        {{ $contenus->links() }}
                    </div>
                    @endif

                    @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-6 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Aucun contenu pour cette région</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Soyez le premier à partager un contenu culturel pour la région de {{ $region->nom_region }}.
                        </p>
                        <a href="{{ route('contenus.create') }}?region={{ $region->id }}" 
                           class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg inline-flex items-center">
                           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                           </svg>
                           Créer un contenu
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="200">
                <!-- Region Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informations
                    </h3>
                    <div class="space-y-3 text-sm">
                        @if($region->localisation)
                        <div class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-gray-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-700">{{ $region->localisation }}</span>
                        </div>
                        @endif
                        
                        @if($region->population)
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="text-gray-700">{{ number_format($region->population, 0, ',', ' ') }} habitants</span>
                        </div>
                        @endif
                        
                        @if($region->superficie)
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-gray-700">{{ number_format($region->superficie, 0, ',', ' ') }} km²</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('regions.edit', $region) }}" 
                           class="w-full flex items-center justify-center space-x-2 bg-benin-green text-white px-4 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                           </svg>
                           <span>Modifier</span>
                        </a>
                        
                        <a href="{{ route('contenus.create') }}?region={{ $region->id }}" 
                           class="w-full flex items-center justify-center space-x-2 border border-benin-green text-benin-green px-4 py-3 rounded-lg hover:bg-benin-green hover:text-white transition-all duration-300 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                           </svg>
                           <span>Ajouter un contenu</span>
                        </a>
                        
                        <a href="{{ route('regions.index') }}" 
                           class="w-full flex items-center justify-center space-x-2 border border-gray-300 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-50 transition-all duration-300 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                           </svg>
                           <span>Toutes les régions</span>
                        </a>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Statistiques</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Contenus publiés</span>
                            <span class="font-semibold text-benin-green">{{ $stats['contenus_publies'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Contenus en attente</span>
                            <span class="font-semibold text-benin-yellow">{{ $stats['contenus_attente'] }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Langues parlées</span>
                            <span class="font-semibold text-benin-red">{{ $region->langues_count }}</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
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
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection