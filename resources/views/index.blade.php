@extends('layouts.app')

@section('title', 'Contenus Publiés')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Titre et bouton d'abonnement -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2">Contenus Publiés</h1>
                @if(!auth()->user()->abonnement_valide)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#abonnementModal">
                        <i class="fas fa-crown me-2"></i>S'abonner
                    </button>
                @else
                    <span class="badge bg-success">
                        <i class="fas fa-check-circle me-1"></i>Abonné jusqu'au {{ auth()->user()->date_expiration_abonnement->format('d/m/Y') }}
                    </span>
                @endif
            </div>

            <!-- Liste des contenus -->
            @forelse($contenus as $contenu)
                <div class="card mb-4 shadow-sm">
                    <div class="row g-0">
                        <!-- Image du contenu -->
                        @if($contenu->medias->isNotEmpty())
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $contenu->medias->first()->chemin) }}"
                                     alt="{{ $contenu->titre }}"
                                     class="img-fluid rounded-start"
                                     style="height: 200px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="{{ $contenu->medias->isNotEmpty() ? 'col-md-8' : 'col-12' }}">
                            <div class="card-body">
                                <!-- Badge type de contenu -->
                                <span class="badge bg-info mb-2">
                                    {{ $contenu->typeContenu->nom ?? 'Non spécifié' }}
                                </span>

                                <!-- Titre -->
                                <h5 class="card-title">
                                    <a href="{{ route('contenus.show', $contenu->id) }}" class="text-decoration-none">
                                        {{ $contenu->titre }}
                                    </a>
                                </h5>

                                <!-- Métadonnées -->
                                <div class="d-flex flex-wrap gap-3 mb-2 text-muted small">
                                    <span>
                                        <i class="fas fa-user me-1"></i>
                                        {{ $contenu->auteur->prenom ?? 'Auteur inconnu' }}
                                    </span>
                                    <span>
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $contenu->date_creation->format('d/m/Y') }}
                                    </span>
                                    <span>
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $contenu->region->nom_region ?? 'Non spécifié' }}
                                    </span>
                                    <span>
                                        <i class="fas fa-comments me-1"></i>
                                        {{ $contenu->commentaires->count() }} commentaires
                                    </span>
                                </div>

                                <!-- Extrait du texte -->
                                <p class="card-text">
                                    {{ Str::limit(strip_tags($contenu->texte), 200) }}
                                </p>

                                <!-- Bouton Lire la suite -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('contenus.show', $contenu->id) }}" class="btn btn-outline-primary btn-sm">
                                        Lire la suite <i class="fas fa-arrow-right ms-1"></i>
                                    </a>

                                    <!-- Badge d'accès -->
                                    @if(!($contenu->typeContenu->gratuit ?? true))
                                        <span class="badge bg-warning">
                                            <i class="fas fa-lock me-1"></i>Abonnement requis
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="fas fa-unlock me-1"></i>Gratuit
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun contenu publié pour le moment.
                </div>
            @endforelse

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $contenus->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Filtres -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filtres</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('contenus.index') }}">
                        <!-- Filtre par région -->
                        <div class="mb-3">
                            <label class="form-label">Région</label>
                            <select name="region" class="form-select">
                                <option value="">Toutes les régions</option>
                                <!-- Options à remplir dynamiquement -->
                            </select>
                        </div>

                        <!-- Filtre par type de contenu -->
                        <div class="mb-3">
                            <label class="form-label">Type de contenu</label>
                            <select name="type_contenu" class="form-select">
                                <option value="">Tous les types</option>
                                <!-- Options à remplir dynamiquement -->
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Filtrer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistiques d'abonnement -->
            @if(!auth()->user()->abonnement_valide)
                <div class="card border-warning">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-crown me-2"></i>Passer à l'abonnement Premium</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Débloquez tous les contenus exclusifs et profitez de nos avantages premium!
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Accès illimité à tous les contenus</li>
                            <li><i class="fas fa-check text-success me-2"></i>Pas de publicités</li>
                            <li><i class="fas fa-check text-success me-2"></i>Téléchargement des médias</li>
                        </ul>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#abonnementModal">
                            Voir les offres
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal d'abonnement -->
<div class="modal fade" id="abonnementModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choisissez votre abonnement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Offre Mensuelle -->
                    <div class="col-md-6">
                        <div class="card h-100 border-primary">
                            <div class="card-header bg-primary text-white text-center py-3">
                                <h4 class="mb-0">Mensuel</h4>
                            </div>
                            <div class="card-body text-center py-4">
                                <h2 class="display-4">5 000 XOF</h2>
                                <p class="text-muted">par mois</p>
                                <hr>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Accès complet 30 jours</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Tous les contenus</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Support prioritaire</li>
                                </ul>
                                <form action="{{ route('paiement.initier') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="montant" value="5000">
                                    <input type="hidden" name="type_abonnement" value="mensuel">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-credit-card me-2"></i>S'abonner
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Offre Annuelle -->
                    <div class="col-md-6">
                        <div class="card h-100 border-warning">
                            <div class="card-header bg-warning text-dark text-center py-3">
                                <h4 class="mb-0">Annuel</h4>
                                <span class="badge bg-danger">Économisez 20%</span>
                            </div>
                            <div class="card-body text-center py-4">
                                <h2 class="display-4">48 000 XOF</h2>
                                <p class="text-muted">par an</p>
                                <hr>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Accès complet 1 an</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Tous les contenus + exclusivités</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>2 comptes supplémentaires</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Support 24/7</li>
                                </ul>
                                <form action="{{ route('paiement.initier') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="montant" value="48000">
                                    <input type="hidden" name="type_abonnement" value="annuel">
                                    <button type="submit" class="btn btn-warning w-100">
                                        <i class="fas fa-crown me-2"></i>Choisir l'offre annuelle
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Gestion AJAX des commentaires
    document.addEventListener('DOMContentLoaded', function() {
        // Intercepter le formulaire de commentaire
        const commentForm = document.getElementById('commentForm');
        if (commentForm) {
            commentForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Ajouter le nouveau commentaire à la liste
                        addNewComment(data.commentaire);
                        // Réinitialiser le formulaire
                        this.reset();
                        // Mettre à jour le compteur
                        updateCommentCount();
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        }

        function addNewComment(commentaire) {
            const commentsList = document.getElementById('commentsList');
            const newComment = `
                <div class="comment mb-3">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="${commentaire.utilisateur.photo || '/images/default-avatar.png'}"
                                 alt="${commentaire.utilisateur.prenom}"
                                 class="rounded-circle" width="40">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">${commentaire.utilisateur.prenom} ${commentaire.utilisateur.nom}</h6>
                            <small class="text-muted">${new Date(commentaire.date).toLocaleDateString()}</small>
                            <div class="rating mb-2">
                                ${generateStars(commentaire.note)}
                            </div>
                            <p class="mb-0">${commentaire.texte}</p>
                        </div>
                    </div>
                </div>
            `;

            if (commentsList.firstChild) {
                commentsList.insertBefore(createElementFromHTML(newComment), commentsList.firstChild);
            } else {
                commentsList.innerHTML = newComment;
            }
        }

        function generateStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="fas fa-star text-warning"></i>';
                } else {
                    stars += '<i class="far fa-star text-warning"></i>';
                }
            }
            return stars;
        }

        function updateCommentCount() {
            const countElement = document.getElementById('commentCount');
            if (countElement) {
                const currentCount = parseInt(countElement.textContent);
                countElement.textContent = currentCount + 1;
            }
        }

        function createElementFromHTML(htmlString) {
            const div = document.createElement('div');
            div.innerHTML = htmlString.trim();
            return div.firstChild;
        }
    });
</script>
@endpush
