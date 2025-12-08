@extends('layouts.app')

@section('title', 'Créer un Contenu - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Créer un <span class="text-benin-green">Contenu</span>
            </h1>
            <p class="text-xl text-gray-600">
                Partagez une histoire, une recette ou une tradition du Bénin
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <h2 class="text-xl font-bold text-white">Nouveau contenu culturel</h2>
            </div>

            <form action="{{ route('contenus.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

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
                           value="{{ old('titre') }}">
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
                            <option value="{{ $type->id }}" {{ old('id_type_contenu') == $type->id ? 'selected' : '' }}>
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
                            <option value="{{ $region->id }}" {{ old('id_region') == $region->id ? 'selected' : '' }}>
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
                            <option value="{{ $langue->id }}" {{ old('id_langue') == $langue->id ? 'selected' : '' }}>
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
                            Statut
                        </label>
                        <select id="statut" 
                                name="statut"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                            <option value="brouillon" {{ old('statut', 'brouillon') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                            <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente de modération</option>
                            <option value="publié" {{ old('statut') == 'publié' ? 'selected' : '' }}>Publié</option>
                        </select>
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
                              placeholder="Racontez votre histoire, décrivez la recette ou expliquez la tradition...">{{ old('texte') }}</textarea>
                    @error('texte')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('contenus.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 text-center font-medium">
                       Annuler
                    </a>
                    
                    <div class="flex space-x-4">
                        <button type="submit" 
                                name="action" 
                                value="save_draft"
                                class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                            Enregistrer brouillon
                        </button>
                        
                        <button type="submit" 
                                name="action" 
                                value="publish"
                                class="px-6 py-3 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                            Publier le contenu
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-blue-50 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="350">
            <div class="flex items-start space-x-4">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Conseils pour un bon contenu</h3>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li>• Soyez précis et détaillé dans vos descriptions</li>
                        <li>• Mentionnez la région et la communauté concernée</li>
                        <li>• Utilisez la langue la plus appropriée pour le contenu</li>
                        <li>• Vérifiez l'exactitude des informations historiques</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

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