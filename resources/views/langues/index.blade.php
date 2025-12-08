@extends('layouts.app')

@section('title', 'Langues du Bénin - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Langues du <span class="text-benin-green">Bénin</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Découvrez la richesse linguistique et culturelle du pays
            </p>
        </div>

        <!-- Stats & Actions Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-green">{{ $langues->count() }}</div>
                        <div class="text-sm text-gray-500">Langues</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        @php
                            $totalUsers = $langues->sum('users_count');
                        @endphp
                        <div class="text-2xl font-bold text-benin-yellow">{{ $totalUsers }}</div>
                        <div class="text-sm text-gray-500">Utilisateurs</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        @php
                            $totalContenus = $langues->sum('contenus_count');
                        @endphp
                        <div class="text-2xl font-bold text-benin-red">{{ $totalContenus }}</div>
                        <div class="text-sm text-gray-500">Contenus</div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('langues.create') }}" 
                       class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg flex items-center justify-center">
                       <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                       </svg>
                       Nouvelle Langue
                    </a>
                </div>
            </div>
        </div>

        <!-- Langues Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($langues as $index => $langue)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift group" 
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($index % 6) * 100 }}">
                
                <!-- Header avec code langue -->
                <div class="benin-gradient px-6 py-4">
                    <div class="flex items-center justify-between">
                        <span class="text-white font-bold text-lg">{{ $langue->code_langue }}</span>
                        <span class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-sm text-white">
                            {{ $langue->contenus_count }} contenus
                        </span>
                    </div>
                </div>

                <!-- Content Card -->
                <div class="p-6">
                    <!-- Nom de la langue -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-benin-green transition-colors duration-300">
                        {{ $langue->nom_langue }}
                    </h3>

                    <!-- Description -->
                    @if($langue->description)
                    <p class="text-gray-600 mb-4 line-clamp-2">
                        {{ $langue->description }}
                    </p>
                    @endif

                    <!-- Metadata -->
                    <div class="space-y-3 text-sm text-gray-500 mb-4">
                        <div class="flex items-center justify-between">
                            <span>Utilisateurs :</span>
                            <span class="font-medium text-benin-yellow">{{ $langue->users_count }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Contenus :</span>
                            <span class="font-medium text-benin-green">{{ $langue->contenus_count }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <!-- View Link -->
                        <a href="{{ route('langues.show', $langue) }}" 
                           class="text-benin-green hover:text-benin-dark-green transition-colors duration-300 font-medium flex items-center">
                           <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                           </svg>
                           Détails
                        </a>

                        <!-- Edit & Delete -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('langues.edit', $langue) }}" 
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucune langue trouvée</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Commencez par ajouter la première langue pour enrichir notre plateforme.
                </p>
                <a href="{{ route('langues.create') }}" 
                   class="bg-benin-green text-white px-8 py-4 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg inline-flex items-center">
                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                   </svg>
                   Ajouter la première langue
                </a>
            </div>
            @endforelse
        </div>

    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
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