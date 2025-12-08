@extends('layouts.app')

@section('title', 'Types de Média - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Types de <span class="text-benin-green">Média</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Gérez les différents formats de médias supportés
            </p>
        </div>

        <!-- Stats & Actions Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-green">{{ $typesMedia->count() }}</div>
                        <div class="text-sm text-gray-500">Types de média</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        @php
                            $totalMedias = $typesMedia->sum('medias_count');
                        @endphp
                        <div class="text-2xl font-bold text-benin-yellow">{{ $totalMedias }}</div>
                        <div class="text-sm text-gray-500">Médias associés</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Type Form -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Ajouter un type de média</h3>
            <form action="{{ route('types-media.store') }}" method="POST" class="flex space-x-4">
                @csrf
                <div class="flex-1">
                    <input type="text" 
                           name="nom" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                           placeholder="Ex: Image, Vidéo, Audio..."
                           value="{{ old('nom') }}">
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" 
                        class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <span>Ajouter</span>
                </button>
            </form>
        </div>

        <!-- Types List -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type de média
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Médias associés
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($typesMedia as $type)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <!-- Type Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $type->nom }}</div>
                            </td>

                            <!-- Associated Medias -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-benin-green/10 text-benin-green">
                                    {{ $type->medias_count }} médias
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <!-- Edit Button -->
                                    <button type="button" 
                                            onclick="openEditModal({{ $type->id }}, '{{ $type->nom }}')"
                                            class="text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-110"
                                            title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>

                                    <!-- Delete Button -->
                                    @if($type->medias_count === 0)
                                    <form action="{{ route('types-media.destroy', $type) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de média ?')"
                                                class="text-red-600 hover:text-red-800 transition-colors duration-300 transform hover:scale-110"
                                                title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-gray-400 cursor-not-allowed" title="Impossible de supprimer - des médias sont associés">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="w-24 h-24 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun type de média</h3>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                    Commencez par créer le premier type de média.
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md mx-4" data-aos="zoom-in">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Modifier le type</h3>
            <button type="button" 
                    onclick="closeEditModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit_nom" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom du type
                </label>
                <input type="text" 
                       id="edit_nom" 
                       name="nom" 
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300">
                    Annuler
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, nom) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    const nomInput = document.getElementById('edit_nom');
    
    // Set form action and input value
    form.action = `/types-media/${id}`;
    nomInput.value = nom;
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on outside click
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEditModal();
    }
});
</script>

<style>
    input:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
</style>
@endsection