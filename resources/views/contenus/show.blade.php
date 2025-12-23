{{-- Ajoutez cette section après la section de contenu principal --}}
@if($userHasAccess)
    <!-- Section Commentaires -->
    <section class="mt-12 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Commentaires ({{ $contenu->commentaires->count() }})</h2>

        <!-- Formulaire d'ajout de commentaire -->
        @auth
            <div class="mb-8">
                <form id="commentForm" action="{{ route('commentaires.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="id_contenu" value="{{ $contenu->id }}">

                    <div>
                        <label for="texte" class="block text-sm font-medium text-gray-700 mb-2">
                            Votre commentaire
                        </label>
                        <textarea name="texte" id="texte" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent"
                                  placeholder="Partagez vos pensées sur ce contenu..."
                                  required></textarea>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div>
                            <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                                Note (1-5)
                            </label>
                            <div class="flex space-x-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" onclick="setRating({{ $i }})"
                                            class="rating-star w-10 h-10 text-2xl hover:text-yellow-400 focus:outline-none"
                                            data-rating="{{ $i }}">
                                        ★
                                    </button>
                                @endfor
                                <input type="hidden" name="note" id="note" value="3">
                            </div>
                        </div>

                        <button type="submit"
                                class="bg-benin-green hover:bg-benin-dark-green text-white font-medium py-2 px-6 rounded-lg transition-colors">
                            Publier le commentaire
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-gray-700">
                    <a href="{{ route('login') }}" class="text-benin-green hover:underline font-medium">Connectez-vous</a>
                    pour laisser un commentaire
                </p>
            </div>
        @endauth

        <!-- Liste des commentaires -->
        <div class="space-y-6" id="commentsList">
            @foreach($contenu->commentaires->sortByDesc('created_at') as $commentaire)
                <div class="border-b border-gray-200 pb-6 last:border-0">
                    <div class="flex items-start space-x-4">
                        <!-- Avatar utilisateur -->
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-benin-green/10 rounded-full flex items-center justify-center">
                                @if($commentaire->utilisateur->photo)
                                    <img src="{{ asset('storage/' . $commentaire->utilisateur->photo) }}"
                                         alt="{{ $commentaire->utilisateur->prenom }}"
                                         class="w-full h-full rounded-full object-cover">
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
                                    <h4 class="font-bold text-gray-900">
                                        {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                                    </h4>
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
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
                                                        class="text-red-600 hover:text-red-800 text-sm">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <p class="text-gray-700">{{ $commentaire->texte }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            @if($contenu->commentaires->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p class="text-gray-500">Aucun commentaire pour le moment. Soyez le premier à en écrire un !</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Script pour les commentaires AJAX -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des étoiles de notation
        const stars = document.querySelectorAll('.rating-star');
        const noteInput = document.getElementById('note');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                setRating(rating);
            });
        });

        window.setRating = function(rating) {
            noteInput.value = rating;
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

        // Initialiser la notation par défaut
        setRating(3);

        // Soumission AJAX du formulaire de commentaire
        const commentForm = document.getElementById('commentForm');
        if (commentForm) {
            commentForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;

                // Désactiver le bouton
                submitButton.disabled = true;
                submitButton.textContent = 'Publication...';
                submitButton.classList.add('opacity-50');

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Ajouter le nouveau commentaire à la liste
                        const commentsList = document.getElementById('commentsList');

                        const commentHTML = `
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-benin-green/10 rounded-full flex items-center justify-center">
                                            <span class="text-benin-green font-bold text-lg">
                                                ${data.commentaire.utilisateur.prenom ? data.commentaire.utilisateur.prenom.charAt(0).toUpperCase() : 'U'}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <h4 class="font-bold text-gray-900">
                                                    ${data.commentaire.utilisateur.prenom} ${data.commentaire.utilisateur.nom}
                                                </h4>
                                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                    <span>À l'instant</span>
                                                    <span>•</span>
                                                    <div class="flex items-center">
                                                        ${'★'.repeat(data.commentaire.note)}${'☆'.repeat(5 - data.commentaire.note)}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-700">${data.commentaire.texte}</p>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Insérer au début de la liste
                        if (commentsList.children.length > 0 && commentsList.children[0].classList.contains('text-center')) {
                            commentsList.innerHTML = commentHTML + commentsList.innerHTML;
                        } else {
                            commentsList.insertAdjacentHTML('afterbegin', commentHTML);
                        }

                        // Réinitialiser le formulaire
                        commentForm.reset();
                        setRating(3);

                        // Afficher une notification
                        showNotification(data.message, 'success');

                        // Mettre à jour le compteur
                        const commentCount = document.querySelector('h2').textContent.match(/\d+/);
                        if (commentCount) {
                            const newCount = parseInt(commentCount[0]) + 1;
                            document.querySelector('h2').textContent =
                                document.querySelector('h2').textContent.replace(/\d+/, newCount);
                        }
                    } else {
                        throw new Error(data.message || 'Erreur lors de la publication');
                    }
                } catch (error) {
                    showNotification(error.message, 'error');
                } finally {
                    // Réactiver le bouton
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                    submitButton.classList.remove('opacity-50');
                }
            });
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }
    });
    </script>
@else
    <!-- Section pour les non-abonnés -->
    <section class="mt-12 bg-gradient-to-r from-benin-green to-benin-dark-green rounded-xl shadow-lg p-8 text-white">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">Contenu réservé aux abonnés</h2>
            <p class="mb-6 opacity-90">
                Abonnez-vous pour accéder à ce contenu premium et à toute notre bibliothèque culturelle
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('abonnement.index') }}"
                   class="bg-white hover:bg-gray-100 text-benin-green font-bold py-3 px-6 rounded-lg transition-colors">
                    Voir les offres d'abonnement
                </a>
                <a href="{{ route('contenus.index') }}"
                   class="border-2 border-white text-white hover:bg-white hover:text-benin-green font-bold py-3 px-6 rounded-lg transition-colors">
                    Explorer les contenus gratuits
                </a>
            </div>
        </div>
    </section>
@endif
