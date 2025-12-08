@extends('layouts.app')

@section('title', 'Accueil - Culture Bénin')

@section('content')
    <!-- Hero Section avec Vidéo Arrière-plan -->
    <section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden text-white">
        <!-- Vidéo Arrière-plan -->
        <div class="absolute inset-0 z-0">
            <video autoplay muted loop playsinline class="w-full h-full object-cover"
                poster="{{ asset('images/video-poster.jpg') }}"> <!-- Image de remplacement -->
                <source src="{{ asset('bg.mp4') }}" type="video/mp4">
                <!-- Fallback image si la vidéo ne charge pas -->
                <div class="absolute inset-0 benin-gradient"></div>
            </video>

            <!-- Overlay pour meilleure lisibilité -->
            <div class="absolute inset-0 bg-black/50"></div>

            <!-- Overlay gradient supplémentaire -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/30"></div>
        </div>

        <!-- Formes décoratives animées -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float z-10"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white/10 rounded-full animate-float z-10"
            style="animation-delay: 2s;"></div>
        <div class="absolute top-1/3 right-1/4 w-16 h-16 bg-white/10 rounded-full animate-pulse-slow z-10"></div>

        <!-- Contenu principal -->
        <div class="relative z-20 text-center max-w-4xl mx-auto px-4">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in-up text-glow" data-aos="fade-down">
                Bienvenue, <span class="text-benin-yellow">{{ Auth::user()->prenom }}</span> !
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-200 leading-relaxed animate-fade-in-up" data-aos="fade-up"
                data-aos-delay="200">
                Prêt à explorer la richesse culturelle du Bénin ? Votre voyage commence ici.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up" data-aos="fade-up"
                data-aos-delay="400">
                <a href="{{ route('contenus.index') }}"
                    class="group bg-benin-yellow text-gray-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-3xl relative overflow-hidden z-20">
                    <span class="relative z-10">Explorer les contenus</span>
                    <div
                        class="absolute inset-0 bg-white/20 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300">
                    </div>
                </a>
                <a href="#navigation"
                    class="group border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-300 relative overflow-hidden z-20">
                    <span class="relative z-10">Découvrir les régions</span>
                    <div
                        class="absolute inset-0 bg-white transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300">
                    </div>
                </a>
            </div>
        </div>

        <!-- Scroll indicator animé -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce-slow z-20" data-aos="fade-up"
            data-aos-delay="800">
            <div class="w-6 h-10 border-2 border-white rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- Section Statistiques Personnelles -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Votre <span class="text-benin-green">exploration</span> en chiffres
                </h2>
                <p class="text-lg text-gray-600">
                    Découvrez l'étendue du patrimoine culturel disponible
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div data-aos="fade-up" data-aos-delay="100" class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                    <div class="text-3xl md:text-5xl font-bold text-benin-green mb-2">{{ $stats['contenus'] ?? 0 }}</div>
                    <div class="text-gray-600 font-medium">Contenus culturels</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                    <div class="text-3xl md:text-5xl font-bold text-benin-yellow mb-2">{{ $stats['regions'] ?? 0 }}</div>
                    <div class="text-gray-600 font-medium">Régions couvertes</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="300" class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                    <div class="text-3xl md:text-5xl font-bold text-benin-red mb-2">{{ $stats['langues'] ?? 0 }}</div>
                    <div class="text-gray-600 font-medium">Langues locales</div>
                </div>
                <div data-aos="fade-up" data-aos-delay="400" class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                    <div class="text-3xl md:text-5xl font-bold text-benin-green mb-2">{{ $stats['utilisateurs'] ?? 0 }}
                    </div>
                    <div class="text-gray-600 font-medium">Membres actifs</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Navigation Rapide -->
    <section id="navigation" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Commencez votre <span class="text-benin-green">exploration</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Accédez rapidement aux différentes sections de la plateforme
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Carte Contenus -->
                <a href="{{ route('contenus.index') }}"
                    class="bg-white rounded-2xl p-8 shadow-lg hover-lift group transition-all duration-300 border-2 border-transparent hover:border-benin-green/20"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-20 h-20 bg-benin-green/10 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Contenus Culturels</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Découvrez les histoires, recettes, traditions et savoirs locaux enrichis de médias variés
                    </p>
                    <div class="mt-6 flex justify-center">
                        <span
                            class="bg-benin-green text-white px-4 py-2 rounded-full text-sm font-medium group-hover:scale-105 transition-transform duration-300">
                            Explorer ›
                        </span>
                    </div>
                </a>

                <!-- Carte Régions -->
                <a href="{{ route('regions.index') }}"
                    class="bg-white rounded-2xl p-8 shadow-lg hover-lift group transition-all duration-300 border-2 border-transparent hover:border-benin-yellow/20"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-20 h-20 bg-benin-yellow/10 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-benin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Régions du Bénin</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Explorez la diversité culturelle organisée par région et communauté à travers le pays
                    </p>
                    <div class="mt-6 flex justify-center">
                        <span
                            class="bg-benin-yellow text-gray-900 px-4 py-2 rounded-full text-sm font-medium group-hover:scale-105 transition-transform duration-300">
                            Découvrir ›
                        </span>
                    </div>
                </a>

                <!-- Carte Langues -->
                <a href="{{ route('langues.index') }}"
                    class="bg-white rounded-2xl p-8 shadow-lg hover-lift group transition-all duration-300 border-2 border-transparent hover:border-benin-red/20"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-20 h-20 bg-benin-red/10 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-benin-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Langues Locales</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Plongez dans la richesse linguistique avec des contenus disponibles dans toutes les langues
                        nationales
                    </p>
                    <div class="mt-6 flex justify-center">
                        <span
                            class="bg-benin-red text-white px-4 py-2 rounded-full text-sm font-medium group-hover:scale-105 transition-transform duration-300">
                            Apprendre ›
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Derniers Contenus -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Contenus <span class="text-benin-green">récents</span>
                </h2>
                <p class="text-lg text-gray-600">
                    Découvrez les dernières contributions de notre communauté
                </p>
            </div>

            @if ($latestContents && $latestContents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($latestContents as $index => $content)
                        <div class="bg-gray-50 rounded-2xl shadow-lg overflow-hidden hover-lift group border border-gray-100"
                            data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="bg-benin-green text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $content->typeContenu->nom ?? 'Culture' }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $content->created_at->diffForHumans() }}</span>
                                </div>
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-3 group-hover:text-benin-green transition-colors duration-300">
                                    {{ $content->titre }}
                                </h3>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit($content->texte, 120) }}
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        @if ($content->auteur)
                                            {{ $content->auteur->prenom }} {{ $content->auteur->nom }}
                                        @else
                                            Auteur inconnu
                                        @endif
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        {{ $content->region->nom_region ?? 'Bénin' }}
                                    </span>
                                </div>
                                <a href="{{ route('contenus.show', $content->id) }}"
                                    class="inline-flex items-center text-benin-green hover:text-benin-dark-green font-medium group-hover:translate-x-2 transition-all duration-300">
                                    Lire la suite
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12" data-aos="fade-up">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <p class="text-gray-600 text-lg mb-4">Aucun contenu publié pour le moment.</p>
                    <p class="text-gray-500 text-sm">Soyez le premier à partager notre patrimoine culturel !</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Section CTA Finale -->
    <section class="py-16 benin-gradient text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4" data-aos="zoom-in">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Votre aventure culturelle vous attend
            </h2>
            <p class="text-xl mb-8 text-green-100">
                Explorez, apprenez et contribuez à préserver notre riche patrimoine pour les générations futures
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contenus.index') }}"
                    class="bg-white text-benin-green px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-2xl">
                    Commencer l'exploration
                </a>
                <a href="{{ route('regions.index') }}"
                    class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-300">
                    Découvrir les régions
                </a>
            </div>
        </div>
    </section>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection
