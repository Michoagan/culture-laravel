@extends('layouts.app')

@section('title', 'Créer une Région - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Créer une <span class="text-benin-green">Région</span>
            </h1>
            <p class="text-xl text-gray-600">
                Ajoutez une nouvelle région du Bénin à la plateforme
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <h2 class="text-xl font-bold text-white">Nouvelle région</h2>
            </div>

            <form action="{{ route('regions.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Nom de la région -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <label for="nom_region" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de la région *
                    </label>
                    <input type="text" 
                           id="nom_region" 
                           name="nom_region" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                           placeholder="Ex: Atlantique, Zou, Borgou..."
                           value="{{ old('nom_region') }}">
                    @error('nom_region')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div data-aos="fade-up" data-aos-delay="150">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 resize-vertical"
                              placeholder="Décrivez la région, ses particularités culturelles, son histoire...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Localisation & Population -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="200">
                    <!-- Localisation -->
                    <div>
                        <label for="localisation" class="block text-sm font-medium text-gray-700 mb-2">
                            Localisation
                        </label>
                        <input type="text" 
                               id="localisation" 
                               name="localisation" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                               placeholder="Ex: Sud du Bénin"
                               value="{{ old('localisation') }}">
                        @error('localisation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Population -->
                    <div>
                        <label for="population" class="block text-sm font-medium text-gray-700 mb-2">
                            Population
                        </label>
                        <input type="number" 
                               id="population" 
                               name="population" 
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                               placeholder="Ex: 1500000"
                               value="{{ old('population') }}">
                        @error('population')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Superficie & Langues -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="250">
                    <!-- Superficie -->
                    <div>
                        <label for="superficie" class="block text-sm font-medium text-gray-700 mb-2">
                            Superficie (km²)
                        </label>
                        <input type="number" 
                               id="superficie" 
                               name="superficie" 
                               min="0" 
                               step="0.01"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                               placeholder="Ex: 3255.25"
                               value="{{ old('superficie') }}">
                        @error('superficie')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Langues -->
                    <div>
                        <label for="langues" class="block text-sm font-medium text-gray-700 mb-2">
                            Langues parlées
                        </label>
                        <select id="langues" 
                                name="langues[]" 
                                multiple
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 h-32">
                            @foreach($langues as $langue)
                            <option value="{{ $langue->id }}" {{ in_array($langue->id, old('langues', [])) ? 'selected' : '' }}>
                                {{ $langue->nom_langue }} ({{ $langue->code_langue }})
                            </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs langues</p>
                        @error('langues')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('regions.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 text-center font-medium">
                       Annuler
                    </a>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                        Créer la région
                    </button>
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
                    <h3 class="font-semibold text-blue-900 mb-2">Conseils pour créer une région</h3>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li>• Utilisez le nom officiel de la région</li>
                        <li>• Incluez les langues principales parlées dans la région</li>
                        <li>• Fournissez une description riche du patrimoine culturel</li>
                        <li>• Les données de population et superficie aident à la contextualisation</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    input:focus, select:focus, textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
</style>
@endsection