@extends('layouts.appy')

@section('title', 'Découvrir la Culture Béninoise')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    
    <!-- Hero Section -->
    <div class="relative bg-benin-green overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 alt="Culture Bénin" 
                 class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-benin-green/90 to-benin-green/95 mix-blend-multiply"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight" data-aos="fade-down">
                Explorez la Richesse<br/>
                <span class="text-benin-yellow">Culturelle du Bénin</span>
            </h1>
            <p class="text-xl text-green-100 max-w-2xl mx-auto mb-10" data-aos="fade-up" data-aos-delay="100">
                Une collection unique de contes, recettes, traditions et musiques pour reconnecter avec vos racines.
            </p>
            
            @if(Auth::check() && Auth::user()->id_role === 1)
                <div data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('contenus.create') }}" 
                       class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-benin-green bg-white hover:bg-gray-50 md:text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Créer un nouveau contenu
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Filtres et Recherche -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10" data-aos="fade-up">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-100 dark:border-gray-700">
            <form method="GET" action="{{ route('contenus.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Rechercher une histoire, un lieu, une tradition..." 
                               class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border-none rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green placeholder-gray-400 transition-all">
                    </div>
                </div>
                
                <div>
                    <select name="type" onchange="this.form.submit()" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border-none rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green cursor-pointer">
                        <option value="">Tous les types</option>
                        @foreach($typesContenu as $type)
                            <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                {{ $type->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <select name="region" onchange="this.form.submit()" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border-none rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green cursor-pointer">
                        <option value="">Toutes les régions</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>
                                {{ $region->nom_region }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Grille de Contenus -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($contenus->isEmpty())
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Aucun contenu trouvé</h3>
                <p class="text-gray-500 dark:text-gray-400">Essayez de modifier vos filtres ou revenez plus tard.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($contenus as $index => $contenu)
                <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col h-full group"
                         data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    
                    <!-- Image -->
                    <div class="relative h-56 overflow-hidden">
                        @if($contenu->image)
                            <img src="{{ asset('storage/' . $contenu->image) }}" alt="{{ $contenu->titre }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-benin-green to-teal-800 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Badge Type -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-gray-900 dark:text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                {{ $contenu->typeContenu->nom ?? 'Culture' }}
                            </span>
                        </div>

                        <!-- Cadenas si Premium -->
                        @php
                            $isPremium = !($contenu->typeContenu->gratuit ?? true);
                            $hasAccess = Auth::check() && (Auth::user()->id_role === 1 || Auth::user()->abonnement_valide);
                        @endphp
                        
                        @if($isPremium && !$hasAccess)
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center backdrop-blur-[2px]">
                                <div class="bg-white/20 p-3 rounded-full backdrop-blur-md border border-white/40">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <!-- Méta -->
                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-3 space-x-2">
                            <span class="flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $contenu->region->nom_region ?? 'Bénin' }}
                            </span>
                            <span>&bull;</span>
                            <span>{{ $contenu->created_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-benin-green transition-colors">
                            <a href="{{ route('contenus.show', $contenu) }}">
                                {{ $contenu->titre }}
                            </a>
                        </h3>

                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($contenu->texte, 120) }}
                        </p>

                        <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                            <a href="{{ route('contenus.show', $contenu) }}" 
                               class="text-benin-green hover:text-benin-dark-green font-bold text-sm inline-flex items-center group-hover:translate-x-1 transition-transform">
                                Lire la suite
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>

                            <!-- Actions Admin (Cachées pour les utilisateurs) -->
                            @if(Auth::check() && Auth::user()->id_role === 1)
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('contenus.edit', $contenu) }}" 
                                       class="text-gray-400 hover:text-blue-500 transition-colors p-1"
                                       title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $contenus->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
