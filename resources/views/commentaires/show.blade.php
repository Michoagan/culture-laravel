@extends('layouts.app')

@section('title', 'Détail du Commentaire - Culture Bénin')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="benin-gradient text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-glow" data-aos="fade-up">
                Commentaire
            </h1>
            
            <!-- Metadata -->
            <div class="flex flex-wrap justify-center items-center gap-6 text-sm mb-8" data-aos="fade-up" data-aos-delay="200">
                <!-- Auteur -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>{{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}</span>
                </div>
                
                <!-- Date -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $commentaire->date->translatedFormat('d F Y') }}</span>
                </div>

                <!-- Note -->
                @if($commentaire->note)
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <div class="flex items-center space-x-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $commentaire->note ? 'text-benin-yellow' : 'text-white/60' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <span>{{ $commentaire->note }}/5</span>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="max-w-4xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <article class="lg:col-span-3" data-aos="fade-up">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <!-- Comment Text -->
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $commentaire->texte }}</p>
                    </div>

                    <!-- Contenu associé -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Sur le contenu</h3>
                        <a href="{{ route('contenus.show', $commentaire->contenu) }}" 
                           class="block p-6 rounded-lg border border-gray-200 hover:border-benin-green hover:bg-gray-50 transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-benin-green transition-colors duration-300">
                                        {{ $commentaire->contenu->titre }}
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-2 line-clamp-2">
                                        {{ $commentaire->contenu->texte }}
                                    </p>
                                    <div class="flex items-center space-x-4 mt-3 text-sm text-gray-500">
                                        <span class="bg-gray-100 px-2 py-1 rounded">
                                            {{ $commentaire->contenu->typeContenu->nom ?? 'Culture' }}
                                        </span>
                                        <span>{{ $commentaire->contenu->region->nom_region ?? 'Bénin' }}</span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-benin-green transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="300">
                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('commentaires.edit', $commentaire) }}" 
                           class="w-full flex items-center justify-center space-x-2 bg-benin-green text-white px-4 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                           </svg>
                           <span>Modifier</span>
                        </a>
                        
                        <a href="{{ route('commentaires.index') }}" 
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
                            <span class="text-gray-600">Auteur</span>
                            <span class="font-medium text-gray-900">
                                {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Posté le</span>
                            <span class="font-medium text-gray-900">
                                {{ $commentaire->date->format('d/m/Y') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">À</span>
                            <span class="font-medium text-gray-900">
                                {{ $commentaire->date->format('H:i') }}
                            </span>
                        </div>
                        @if($commentaire->note)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Note</span>
                            <span class="font-medium text-benin-yellow">{{ $commentaire->note }}/5</span>
                        </div>
                        @endif
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
</style>
@endsection