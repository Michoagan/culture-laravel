@extends('layouts.app')

@section('title', $contenu->titre . ' - Culture Bénin')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="benin-gradient text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <!-- Floating elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white/10 rounded-full animate-float" style="animation-delay: 2s;"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <!-- Type Badge -->
            <div class="inline-block bg-white/20 backdrop-blur-sm rounded-2xl px-6 py-3 mb-6" data-aos="fade-down">
                <span class="text-sm font-medium">{{ $contenu->typeContenu->nom ?? 'Culture' }}</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-glow" data-aos="fade-up">{{ $contenu->titre }}</h1>
            
            <!-- Metadata -->
            <div class="flex flex-wrap justify-center items-center gap-6 text-sm mb-8" data-aos="fade-up" data-aos-delay="200">
                <!-- Author -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>{{ $contenu->auteur->prenom ?? 'Anonyme' }} {{ $contenu->auteur->nom ?? '' }}</span>
                </div>
                
                <!-- Region -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <span>{{ $contenu->region->nom_region ?? 'Bénin' }}</span>
                </div>
                
                <!-- Language -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                    <span>{{ $contenu->langue->nom_langue ?? 'Multilingue' }}</span>
                </div>
                
                <!-- Date -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $contenu->created_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-2" data-aos="fade-up" data-aos-delay="300">
                @switch($contenu->statut)
                    @case('publié')
                        <div class="w-2 h-2 bg-benin-green rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium">Publié</span>
                        @break
                    @case('brouillon')
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                        <span class="text-sm font-medium">Brouillon</span>
                        @break
                    @case('en_attente')
                        <div class="w-2 h-2 bg-benin-yellow rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium">En attente de modération</span>
                        @break
                @endswitch
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="max-w-4xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <article class="lg:col-span-3" data-aos="fade-up">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <!-- Content Text -->
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($contenu->texte)) !!}
                    </div>

                    <!-- Medias Section -->
                    @if($contenu->medias->count() > 0)
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Médias associés</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($contenu->medias as $media)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-benin-green/10 rounded-full flex items-center justify-center">
                                        @if($media->typeMedia->nom === 'image')
                                            <svg class="w-5 h-5 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        @elseif($media->typeMedia->nom === 'audio')
                                            <svg class="w-5 h-5 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 016 0v6a3 3 0 01-3 3z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $media->description ?? 'Média' }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">{{ $media->typeMedia->nom }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="300">
                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('contenus.edit', $contenu) }}" 
                           class="w-full flex items-center justify-center space-x-2 bg-benin-green text-white px-4 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                           </svg>
                           <span>Modifier</span>
                        </a>
                        
                        <a href="{{ route('contenus.index') }}" 
                           class="w-full flex items-center justify-center space-x-2 border border-gray-300 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-50 transition-all duration-300 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                           </svg>
                           <span>Retour à la liste</span>
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informations</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Créé le</span>
                            <span class="font-medium text-gray-900">{{ $contenu->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Modifié le</span>
                            <span class="font-medium text-gray-900">{{ $contenu->updated_at->format('d/m/Y') }}</span>
                        </div>
                        @if($contenu->date_validation)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Validé le</span>
                            <span class="font-medium text-gray-900">{{ $contenu->date_validation->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Content -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Dans la même région</h3>
                    <div class="space-y-3">
                        @foreach($relatedContents as $related)
                        <a href="{{ route('contenus.show', $related) }}" 
                           class="block p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300 group">
                            <h4 class="font-medium text-gray-900 group-hover:text-benin-green transition-colors duration-300 line-clamp-2">
                                {{ $related->titre }}
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $related->typeContenu->nom }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <!-- Comments Section -->
<section class="max-w-4xl mx-auto px-4 pb-16">
    <div class="bg-white rounded-2xl shadow-lg p-8" data-aos="fade-up">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-900">
                Commentaires ({{ $contenu->commentaires->count() }})
            </h3>
            <a href="{{ route('commentaires.create', ['contenu' => $contenu->id]) }}" 
               class="bg-benin-green text-white px-4 py-2 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
               + Ajouter un commentaire
            </a>
        </div>
        
        <!-- Include comments list -->
        @include('commentaires._list', ['commentaires' => $contenu->commentaires])
    </div>
</section>
    @endif
</div>

<style>
    .prose {
        line-height: 1.75;
    }
    .prose p {
        margin-bottom: 1.5em;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    <style>
/* Correction pour le texte principal en mode sombre */
.dark .prose {
    color: #ffffff !important;
}

.dark .prose p,
.dark .prose h1,
.dark .prose h2,
.dark .prose h3,
.dark .prose h4,
.dark .prose h5,
.dark .prose h6,
.dark .prose span,
.dark .prose strong {
    color: #ffffff !important;
}

/* Optionnel : couleurs du texte secondaire */
.dark .prose a {
    color: #ffdd55 !important;
}
</style>

</style>
@endsection