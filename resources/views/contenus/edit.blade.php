@extends('layouts.app')

@section('title', 'Modifier ' . $contenu->titre . ' - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Modifier le <span class="text-benin-green">contenu</span>
            </h1>
            <p class="text-xl text-gray-600">
                Mettez à jour votre contribution culturelle
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Modification du contenu</h2>
                    <span class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-sm">
                        {{ $contenu->typeContenu->nom }}
                    </span>
                </div>
            </div>

            <form action="{{ route('contenus.update', $contenu) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Titre -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                        Titre du contenu *
                    </label>
                    <input type="text" 
                           id="titre" 
                           name="titre" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                           placeholder="Ex: La légende du Roi Béhanzin"
                           value="{{ old('titre', $contenu->titre) }}">
                    @error('titre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type de contenu & Région -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="150">
                    <!-- Type -->
                    <div>
                        <label for="id_type_contenu" class="block text-sm font-medium text-gray-700 mb-2">
                            Type de contenu *
                        </label>
                        <select id="id_type_contenu" 
                                name="id_type_contenu" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                            <option value="">Sélectionnez un type</option>
                            @foreach($typesContenu as $type)
                            <option value="{{ $type->id }}" {{ old('id_type_contenu', $contenu->id_type_contenu) == $type->id ? 'selected' : '' }}>
                                {{ $type->nom }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_type_contenu')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Région -->
                    <div>
                        <label for="id_region" class="block text-sm font-medium text-gray-700 mb-2">
                            Région *
                        </label>
                        <select id="id_region" 
                                name="id_region" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                            <option value="">Sélectionnez une région</option>
                            @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ old('id_region', $contenu->id_region) == $region->id ? 'selected' : '' }}>
                                {{ $region->nom_region }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_region')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Langue & Statut -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="200">
                    <!-- Langue -->
                    <div>
                        <label for="id_langue" class="block text-sm font-medium text-gray-700 mb-2">
                            Langue *
                        </label>
                        <select id="id_langue" 
                                name="id_langue" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                            <option value="">Sélectionnez une langue</option>
                            @foreach($langues as $langue)
                            <option value="{{ $langue->id }}" {{ old('id_langue', $contenu->id_langue) == $langue->id ? 'selected' : '' }}>
                                {{ $langue->nom_langue }} ({{ $langue->code_langue }})
                            </option>
                            @endforeach
                        </select>
                        @error('id_langue')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">
                            Statut *
                        </label>
                        <select id="statut" 
                                name="statut"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                            <option value="brouillon" {{ old('statut', $contenu->statut) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                            <option value="en_attente" {{ old('statut', $contenu->statut) == 'en_attente' ? 'selected' : '' }}>En attente de modération</option>
                            <option value="publié" {{ old('statut', $contenu->statut) == 'publié' ? 'selected' : '' }}>Publié</option>
                            <option value="rejeté" {{ old('statut', $contenu->statut) == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                        @error('statut')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contenu -->
                <div data-aos="fade-up" data-aos-delay="250">
                    <label for="texte" class="block text-sm font-medium text-gray-700 mb-2">
                        Contenu *
                    </label>
                    <textarea id="texte" 
                              name="texte" 
                              required
                              rows="12"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 resize-vertical"
                              placeholder="Racontez votre histoire, décrivez la recette ou expliquez la tradition...">{{ old('texte', $contenu->texte) }}</textarea>
                    @error('texte')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex space-x-4">
                        <a href="{{ route('contenus.show', $contenu) }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 text-center font-medium">
                           Annuler
                        </a>
                        
                        <button type="button"
                                onclick="confirmDelete()"
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                            Supprimer
                        </button>
                    </div>
                    
                    <div class="flex space-x-4">
                        <button type="submit" 
                                name="action" 
                                value="save"
                                class="px-6 py-3 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Form -->
            <form id="delete-form" action="{{ route('contenus.destroy', $contenu) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>

    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.')) {
        document.getElementById('delete-form').submit();
    }
}

// Auto-resize textarea
document.getElementById('texte').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});
</script>

<style>
    textarea {
        min-height: 200px;
    }
    
    input:focus, select:focus, textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
</style>
@endsection