@extends('layouts.app')

@section('title', 'Gestion des Commentaires - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Gestion des <span class="text-benin-green">Commentaires</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Modérez les contributions de la communauté
            </p>
        </div>

        <!-- Stats & Actions Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-green">{{ $commentaires->count() }}</div>
                        <div class="text-sm text-gray-500">Commentaires</div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('commentaires.create') }}" 
                       class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg flex items-center justify-center">
                       <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                       </svg>
                       Nouveau Commentaire
                    </a>
                </div>
            </div>
        </div>

        <!-- Commentaires Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Utilisateur
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contenu
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Commentaire
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Note
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($commentaires as $commentaire)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- User Info -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($commentaire->utilisateur->photo)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $commentaire->utilisateur->photo) }}" alt="{{ $commentaire->utilisateur->prenom }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-benin-green flex items-center justify-center">
                                                <span class="text-white font-medium text-sm">
                                                    {{ strtoupper(substr($commentaire->utilisateur->prenom, 0, 1)) }}{{ strtoupper(substr($commentaire->utilisateur->nom, 0, 1)) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $commentaire->utilisateur->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Contenu -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <a href="{{ route('contenus.show', $commentaire->contenu) }}" class="hover:text-benin-green transition-colors duration-300">
                                    {{ Str::limit($commentaire->contenu->titre, 30) }}
                                </a>
                            </td>

                            <!-- Commentaire -->
                            <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                <div class="line-clamp-2">{{ $commentaire->texte }}</div>
                            </td>

                            <!-- Note -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($commentaire->note)
                                <div class="flex items-center space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $commentaire->note ? 'text-benin-yellow' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                @else
                                <span class="text-sm text-gray-500">-</span>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $commentaire->date->format('d/m/Y') }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('commentaires.show', $commentaire) }}" 
                                       class="text-benin-green hover:text-benin-dark-green transition-colors duration-300 transform hover:scale-110"
                                       title="Voir">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    
                                    <a href="{{ route('commentaires.edit', $commentaire) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-110"
                                       title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="w-24 h-24 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun commentaire trouvé</h3>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                    Les commentaires de la communauté apparaîtront ici.
                                </p>
                                <a href="{{ route('commentaires.create') }}" 
                                   class="bg-benin-green text-white px-8 py-4 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg inline-flex items-center">
                                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                   </svg>
                                   Créer le premier commentaire
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
</style>
@endsection