
    <!-- Section Commentaires -->
    <section class="mt-12 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Commentaires ({{ $contenu->commentaires->count() }})</h2>

        <!-- Formulaire d'ajout de commentaire -->
        @auth
            <div class="mb-8">
                <form id="commentForm" action="{{ route('commentaires.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="id_contenu" value="{{ $contenu->id }}">

                    <div>
                        <label for="texte" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Votre commentaire
                        </label>
                        <textarea name="texte" id="texte" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent"
                                  placeholder="Partagez vos pensées sur ce contenu..."
                                  required></textarea>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div>
                            <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Note (1-5)
                            </label>
                            <div class="flex space-x-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" onclick="setRating({{ $i }})"
                                            class="rating-star w-10 h-10 text-2xl text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors"
                                            data-rating="{{ $i }}">
                                        ★
                                    </button>
                                @endfor
                                <input type="hidden" name="note" id="note" value="3">
                            </div>
                        </div>

                        <button type="submit"
                                class="bg-benin-green hover:bg-benin-dark-green text-white font-medium py-2 px-6 rounded-lg transition-colors ml-auto">
                            Publier le commentaire
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6 text-center">
                <p class="text-gray-700 dark:text-gray-300">
                    <a href="{{ route('login') }}" class="text-benin-green hover:underline font-bold">Connectez-vous</a>
                    pour laisser un commentaire
                </p>
            </div>
        @endauth

        <!-- Liste des commentaires -->
        <div class="space-y-6" id="commentsList">
            @foreach($contenu->commentaires->sortByDesc('created_at') as $commentaire)
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0">
                    <div class="flex items-start space-x-4">
                        <!-- Avatar utilisateur -->
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-benin-green/10 rounded-full flex items-center justify-center overflow-hidden">
                                @if($commentaire->utilisateur->photo)
                                    <img src="{{ asset('storage/' . $commentaire->utilisateur->photo) }}"
                                         alt="{{ $commentaire->utilisateur->prenom }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <span class="text-benin-green font-bold text-lg">
                                        {{ strtoupper(substr($commentaire->utilisateur->prenom, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Contenu du commentaire -->
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">
                                        {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                                    </h4>
                                    <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                        <span>{{ $commentaire->created_at->diffForHumans() }}</span>
                                        <span>•</span>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="{{ $i <= $commentaire->note ? 'text-yellow-400' : 'text-gray-300' }}">
                                                    ★
                                                </span>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions du commentaire -->
                                @auth
                                    @if(Auth::id() == $commentaire->id_utilisateur || Auth::user()->id_role == 1)
                                        <div class="flex space-x-2">
                                            <form action="{{ route('commentaires.destroy', $commentaire) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Supprimer ce commentaire ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-500 hover:text-red-700 text-sm font-medium transition-colors">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $commentaire->texte }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($contenu->commentaires->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400">Aucun commentaire pour le moment. Soyez le premier à donner votre avis !</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Script pour les commentaires AJAX et notation -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Gestion des étoiles ---
        const stars = document.querySelectorAll('.rating-star');
        const noteInput = document.getElementById('note');

        window.setRating = function(rating) {
            if(noteInput) noteInput.value = rating;
            stars.forEach(star => {
                const starRating = star.getAttribute('data-rating');
                if (starRating <= rating) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        };

        // Initialiser à 3 étoiles par défaut
        setRating(3);

        stars.forEach(star => {
            star.addEventListener('mouseenter', function() {
                const rating = this.getAttribute('data-rating');
                // Prévisualisation visuelle seulement
                stars.forEach(s => {
                    if (s.getAttribute('data-rating') <= rating) {
                        s.classList.add('text-yellow-300');
                    }
                });
            });
             star.addEventListener('mouseleave', function() {
                 stars.forEach(s => s.classList.remove('text-yellow-300'));
            });
        });
    });
    </script>
