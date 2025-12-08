@extends('layouts.auth')

@section('title', 'Inscription - Culture Bénin')

@section('content')
    <div class="w-full space-y-8" data-aos="fade-up">
        <!-- Carte d'inscription avec glass effect -->
        <div class="glass dark:glass-dark rounded-2xl shadow-xl p-8 space-y-6 border border-white/20">

            <!-- En-tête -->
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-12 w-auto rounded-lg">
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Rejoignez Culture Bénin</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Créez votre compte pour explorer notre patrimoine</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-red-700 dark:text-red-300 text-sm font-medium">Veuillez corriger les erreurs suivantes :</span>
                    </div>
                    <ul class="mt-2 text-red-600 dark:text-red-400 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom *</label>
                        <input id="nom" type="text" name="nom" value="{{ old('nom') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all"
                            placeholder="Votre nom">
                        @error('nom')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prénom *</label>
                        <input id="prenom" type="text" name="prenom" value="{{ old('prenom') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all"
                            placeholder="Votre prénom">
                        @error('prenom')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sexe -->
                    <div>
                        <label for="sexe" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sexe</label>
                        <select id="sexe" name="sexe" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all">
                            <option value="">--</option>
                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                        </select>
                        @error('sexe')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date de naissance -->
                    <div>
                        <label for="date_naissance" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date de naissance</label>
                        <input id="date_naissance" type="date" name="date_naissance" value="{{ old('date_naissance') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all">
                        @error('date_naissance')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email *</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all"
                        placeholder="votre@email.com">
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Mots de passe -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="mot_de_passe" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mot de passe *</label>
                        <input id="mot_de_passe" type="password" name="mot_de_passe" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all"
                            placeholder="••••••••">
                        @error('mot_de_passe')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="mot_de_passe_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirmer le mot de passe *</label>
                        <input id="mot_de_passe_confirmation" type="password" name="mot_de_passe_confirmation" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Préférences et rôle -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Langue (optionnel) -->
                    <div>
                        <label for="id_langue" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Langue préférée</label>
                        <select id="id_langue" name="id_langue" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all">
                            <option value="">Laisser vide</option>
                            @isset($langues)
                                @foreach($langues as $langue)
                                    <option value="{{ $langue->id }}" {{ old('id_langue') == $langue->id ? 'selected' : '' }}>
                                        {{ $langue->nom_langue ?? $langue->nom ?? $langue->label ?? $langue->id }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('id_langue')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Rôle (optionnel) -->
                    <div>
                        <label for="id_role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rôle</label>
                        <select id="id_role" name="id_role" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all">
                            <option value="">Laisser vide</option>
                            @isset($roles)
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('id_role') == $role->id ? 'selected' : '' }}>
                                        {{ $role->nom ?? $role->name ?? $role->label ?? $role->id }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('id_role')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Statut</label>
                        <select id="statut" name="statut" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all">
                            <option value="">--</option>
                            <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                            <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                            <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        </select>
                        @error('statut')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Photo -->
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo de profil</label>
                        <input id="photo" type="file" name="photo" accept="image/*"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all">
                        <p class="text-xs text-gray-500 mt-1">Formats: JPG, PNG, WEBP. Max: 2MB</p>
                        @error('photo')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Bouton d'inscription -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-benin-green text-white font-semibold rounded-lg shadow-lg hover:bg-benin-dark-green transform hover:scale-105 transition-all duration-300">
                        Créer mon compte
                    </button>
                </div>

                <!-- Lien vers connexion -->
                <div class="text-center pt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Déjà un compte ?
                        <a href="{{ route('login') }}" class="font-medium text-benin-yellow hover:text-benin-red ml-1">Se connecter</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
