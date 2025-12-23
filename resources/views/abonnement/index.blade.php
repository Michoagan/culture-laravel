@extends('layouts.appy')

@section('title', 'Abonnement - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Choisissez votre abonnement</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Accédez à la richesse culturelle du Bénin avec un abonnement adapté à vos besoins
            </p>
        </div>

        <!-- Plans d'abonnement -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Plan Mensuel -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 transform hover:scale-105 transition-transform duration-300">
                <div class="text-center mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Abonnement Mensuel</h3>
                    <div class="flex items-center justify-center">
                        <span class="text-4xl font-bold text-benin-green">5,000</span>
                        <span class="text-gray-600 ml-2">FCFA</span>
                    </div>
                    <p class="text-gray-600 text-sm mt-2">par mois</p>
                </div>

                <ul class="space-y-3 mb-8">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Accès à tous les contenus premium</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Contenus exclusifs et archives</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Téléchargement de médias</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Support prioritaire</span>
                    </li>
                </ul>

                <form action="{{ route('paiement.initier') }}" method="POST">
                    @csrf
                    <input type="hidden" name="montant" value="5000">
                    <input type="hidden" name="type_abonnement" value="mensuel">
                    <button type="submit" class="w-full bg-benin-green hover:bg-benin-dark-green text-white font-bold py-3 px-4 rounded-lg transition-colors">
                        S'abonner maintenant
                    </button>
                </form>
            </div>

            <!-- Plan Annuel (Recommandé) -->
            <div class="bg-gradient-to-r from-benin-green to-benin-dark-green rounded-2xl shadow-xl border-2 border-benin-green p-8 transform hover:scale-105 transition-transform duration-300 relative">
                <div class="absolute top-0 right-0 bg-benin-yellow text-gray-900 px-4 py-1 rounded-bl-lg font-bold">
                    Économisez 20%
                </div>

                <div class="text-center mb-8">
                    <h3 class="text-xl font-bold text-white mb-2">Abonnement Annuel</h3>
                    <div class="flex items-center justify-center">
                        <span class="text-4xl font-bold text-white">48,000</span>
                        <span class="text-white/80 ml-2">FCFA</span>
                    </div>
                    <p class="text-white/80 text-sm mt-2">par an (4,000 FCFA/mois)</p>
                </div>

                <ul class="space-y-3 mb-8">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Tous les avantages du plan mensuel</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">2 mois gratuits</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Accès anticipé aux nouveautés</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-white">Certificat de contributeur</span>
                    </li>
                </ul>

                <form action="{{ route('paiement.initier') }}" method="POST">
                    @csrf
                    <input type="hidden" name="montant" value="48000">
                    <input type="hidden" name="type_abonnement" value="annuel">
                    <button type="submit" class="w-full bg-white hover:bg-gray-100 text-benin-green font-bold py-3 px-4 rounded-lg transition-colors">
                        Choisir cette offre
                    </button>
                </form>
            </div>

            <!-- Plan Étudiant -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 transform hover:scale-105 transition-transform duration-300">
                <div class="text-center mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Plan Étudiant</h3>
                    <div class="flex items-center justify-center">
                        <span class="text-4xl font-bold text-benin-green">3,000</span>
                        <span class="text-gray-600 ml-2">FCFA</span>
                    </div>
                    <p class="text-gray-600 text-sm mt-2">par mois</p>
                </div>

                <ul class="space-y-3 mb-8">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Accès complet aux contenus</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Tarif spécial étudiant</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Ressources pédagogiques</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Accès aux forums étudiants</span>
                    </li>
                </ul>

                <form action="{{ route('paiement.initier') }}" method="POST">
                    @csrf
                    <input type="hidden" name="montant" value="3000">
                    <input type="hidden" name="type_abonnement" value="etudiant">
                    <button type="submit" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-900 font-bold py-3 px-4 rounded-lg transition-colors">
                        S'abonner
                    </button>
                </form>
            </div>
        </div>

        <!-- FAQ -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Questions fréquentes</h2>
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Comment fonctionne le paiement ?</h3>
                    <p class="text-gray-600">Les paiements sont sécurisés via FedaPay. Vous recevrez une confirmation par email après chaque paiement réussi.</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Puis-je annuler mon abonnement ?</h3>
                    <p class="text-gray-600">Oui, vous pouvez annuler à tout moment. Votre accès restera actif jusqu'à la fin de la période payée.</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Y a-t-il une période d'essai ?</h3>
                    <p class="text-gray-600">Nous offrons une période d'essai de 7 jours pour découvrir les contenus premium avant de vous abonner.</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Quels moyens de paiement acceptez-vous ?</h3>
                    <p class="text-gray-600">Nous acceptons les cartes bancaires (Visa, Mastercard), les portefeuilles électroniques (Moov Money, Flooz) et les transferts mobiles.</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Comment prouver mon statut d'étudiant ?</h3>
                    <p class="text-gray-600">Une copie de votre carte d'étudiant valide ou un certificat de scolarité vous sera demandé lors de l'inscription au plan étudiant.</p>
                </div>
            </div>
        </div>

        <!-- Section statut abonnement actuel -->
        @auth
            <div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Votre abonnement actuel</h2>

                @if(Auth::user()->abonnement_valide && Auth::user()->date_expiration_abonnement)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="flex items-center mb-2">
                                    <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-lg font-bold text-green-800">Abonnement actif</span>
                                </div>
                                <p class="text-green-700">
                                    Votre abonnement {{ Auth::user()->type_abonnement ?? 'mensuel' }} est actif jusqu'au
                                    <span class="font-bold">{{ Auth::user()->date_expiration_abonnement->format('d/m/Y') }}</span>
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-green-600 mb-2">{{ now()->diffInDays(Auth::user()->date_expiration_abonnement, false) }} jours restants</p>
                                <div class="w-32 h-2 bg-green-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-green-600 rounded-full"
                                         style="width: {{ min(100, max(0, (1 - (now()->diffInDays(Auth::user()->date_expiration_abonnement, false) / 365)) * 100)) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <div>
                                <p class="text-yellow-800 font-bold mb-1">Aucun abonnement actif</p>
                                <p class="text-yellow-700">Vous avez accès uniquement aux contenus gratuits.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endauth

        <!-- CTA -->
        <div class="text-center mt-12">
            <p class="text-gray-600 mb-4">Vous avez des questions ? Notre équipe est là pour vous aider.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:support@culturebenin.bj"
                   class="inline-flex items-center justify-center bg-benin-green hover:bg-benin-dark-green text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    support@culturebenin.bj
                </a>
                <a href="tel:+22900000000"
                   class="inline-flex items-center justify-center border-2 border-benin-green text-benin-green hover:bg-benin-green hover:text-white font-bold py-3 px-6 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    +229 XX XX XX XX
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Script pour les animations et interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation au survol des cartes d'abonnement
    const cards = document.querySelectorAll('.bg-white.rounded-2xl');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Confirmation avant paiement
    const forms = document.querySelectorAll('form[action*="paiement.initier"]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.textContent;

            // Désactiver le bouton pendant le traitement
            button.disabled = true;
            button.textContent = 'Traitement...';
            button.classList.add('opacity-50');

            // Réactiver après 2 secondes si erreur
            setTimeout(() => {
                button.disabled = false;
                button.textContent = originalText;
                button.classList.remove('opacity-50');
            }, 2000);
        });
    });

    // Notification si l'utilisateur n'est pas connecté
    @guest
        const subscribeButtons = document.querySelectorAll('form button[type="submit"]');
        subscribeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Veuillez vous connecter ou vous inscrire pour souscrire à un abonnement.');
                window.location.href = '{{ route("login") }}';
            });
        });
    @endguest
});
</script>
@endsection
