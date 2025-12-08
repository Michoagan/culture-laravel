@extends('layouts.auth')

@section('title', 'Inscription Réussie - Culture Bénin')

@section('content')
    <div class="w-full space-y-8" data-aos="fade-up">
        <!-- Carte de succès -->
        <div class="glass dark:glass-dark rounded-2xl shadow-xl p-8 space-y-6 border border-white/20 text-center">

            <!-- Icône de succès -->
            <div class="flex justify-center mb-4">
                <div class="h-16 w-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center animate-bounce">
                    <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <!-- Message de succès -->
            <div class="space-y-4">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Inscription Réussie !</h2>

                <p class="text-lg text-gray-600 dark:text-gray-300">
                    Félicitations ! Votre compte a été créé avec succès sur Culture Bénin.
                </p>

                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="text-left">
                            <p class="text-blue-800 dark:text-blue-300 text-sm font-semibold">
                                Vérifiez votre boîte email
                            </p>
                            <p class="text-blue-600 dark:text-blue-400 text-sm mt-2 leading-relaxed">
                                Un lien de vérification a été envoyé à votre adresse email.
                                Cliquez sur le lien pour confirmer votre compte et accéder à toutes les fonctionnalités de Culture Bénin.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="text-left">
                            <p class="text-yellow-800 dark:text-yellow-300 text-sm font-semibold">
                                Vérification requise
                            </p>
                            <p class="text-yellow-700 dark:text-yellow-400 text-sm mt-1">
                                Votre compte ne sera pleinement activé qu'après vérification de votre email.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="space-y-3 pt-6">
                <!-- Bouton connexion -->
                <a href="{{ route('login') }}"
                    class="w-full py-3 px-4 bg-benin-green text-white font-semibold rounded-lg shadow-lg hover:bg-benin-dark-green transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-benin-green block text-center">
                    ✓ Se connecter
                </a>

                <!-- Lien vers accueil -->
                <a href="{{ route('home') }}"
                    class="w-full py-3 px-4 border-2 border-benin-green text-benin-green hover:bg-benin-green hover:text-white rounded-lg font-semibold transition-all duration-300 block text-center">
                    ← Retour à l'accueil
                </a>
            </div>

            <!-- Info supplémentaire -->
            <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Vous n'avez pas reçu l'email de vérification ?
                </p>
                <a href="{{ route('verification.send') }}"
                    class="inline-block mt-2 text-benin-green hover:text-benin-dark-green font-semibold underline hover:no-underline transition-all duration-200">
                    Renvoyer l'email de vérification
                </a>
            </div>
        </div>
    </div>
@endsection
