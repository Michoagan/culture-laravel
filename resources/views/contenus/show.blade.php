@extends('layouts.appy')

@section('content')
<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Bouton Retour -->
        <a href="{{ route('contenus.index') }}" class="inline-flex items-center text-benin-green hover:text-benin-dark-green mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour aux contenus
        </a>

        <!-- Contenu Principal -->
        <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-12 border border-gray-100 dark:border-gray-700">
            <!-- Image de couverture -->
            @if($contenu->image)
                <div class="w-full h-96 relative">
                    <img src="{{ asset('storage/' . $contenu->image) }}" alt="{{ $contenu->titre }}" class="w-full h-full object-cover">
                    <div class="absolute top-0 right-0 p-4">
                        <span class="bg-benin-yellow text-benin-red text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                            {{ $contenu->typeContenu->nom ?? 'Article' }}
                        </span>
                    </div>
                </div>
            @endif

            <div class="p-8 md:p-12">
                <!-- En-tête de l'article -->
                <header class="mb-8 border-b border-gray-100 dark:border-gray-700 pb-8">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $contenu->region->nom_region ?? 'Bénin' }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            {{ $contenu->langue->nom_langue ?? 'Français' }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 leading-tight">
                        {{ $contenu->titre }}
                    </h1>

                    <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                        <img src="{{ $contenu->auteur->photo ? asset('storage/' . $contenu->auteur->photo) : 'https://ui-avatars.com/api/?name='.$contenu->auteur->nom }}" 
                             alt="Auteur" class="w-10 h-10 rounded-full mr-3 border-2 border-white shadow-sm">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Par {{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}</p>
                            <p>Publié {{ $contenu->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </header>

                <!-- Corps du texte -->
                <div class="prose prose-lg dark:prose-invert max-w-none">
                    @if($userHasAccess)
                        {!! nl2br(e($contenu->texte)) !!}
                    @else
                        <div class="relative">
                            <!-- Début du texte flouté -->
                            <div class="filter blur-sm select-none opacity-50">
                                {!! nl2br(e(Str::limit($contenu->texte, 300))) !!}
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
                                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...</p>
                            </div>
                            
                            <!-- Message d'abonnement -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md p-8 rounded-xl shadow-2xl text-center border-2 border-benin-green max-w-lg mx-4">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Lecture réservée aux abonnés</h3>
                                    <p class="text-gray-600 dark:text-gray-300 mb-6">Soutenez la culture béninoise et accédez à l'intégralité de nos contenus.</p>
                                    <a href="{{ route('abonnement.index') }}" 
                                       class="inline-block bg-benin-green hover:bg-benin-dark-green text-white font-bold py-3 px-8 rounded-full transition-transform transform hover:scale-105 shadow-md">
                                        S'abonner maintenant
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Galerie Média (Si accès) -->
                @if($userHasAccess && $contenu->medias && $contenu->medias->count() > 0)
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Galerie Média</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($contenu->medias as $media)
                                <div class="rounded-lg overflow-hidden shadow-md">
                                    @if(Str::startsWith($media->type, 'image'))
                                        <img src="{{ asset('storage/' . $media->url) }}" class="w-full h-48 object-cover hover:scale-110 transition-transform duration-500">
                                    @elseif(Str::startsWith($media->type, 'video'))
                                        <video src="{{ asset('storage/' . $media->url) }}" controls class="w-full h-48 bg-black"></video>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>

        <!-- Section Commentaires -->
        @if($userHasAccess)
            @include('contenus.partials.comments', ['contenu' => $contenu])
        @endif

    </div>
</div>
@endsection
