@extends('layouts.app')

@section('title', $contenu->titre)

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Contenu principal -->
        <div class="col-lg-8">
            <!-- Message d'accès restreint -->
            @if(!$userHasAccess)
                <div class="alert alert-warning">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x me-3"></i>
                        <div>
                            <h5 class="alert-heading mb-1">Contenu Premium</h5>
                            <p class="mb-0">Cet article nécessite un abonnement.
                                <a href="#" class="alert-link" data-bs-toggle="modal" data-bs-target="#abonnementModal">
                                    Abonnez-vous pour continuer la lecture
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Titre et métadonnées -->
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('contenus.index') }}">Contenus</a></li>
                        <li class="breadcrumb-item active">{{ $contenu->titre }}</li>
                    </ol>
                </nav>

                <h1 class="display-5 mb-3">{{ $contenu->titre }}</h1>

                <div class="d-flex flex-wrap gap-3 align-items-center mb-4 text-muted">
                    <div class="d-flex align-items-center">
                        <img src="{{ $contenu->auteur->photo ?? '/images/default-avatar.png' }}"
                             alt="{{ $contenu->auteur->prenom ?? 'Auteur' }}"
                             class="rounded-circle me-2" width="32">
                        <span>{{ $contenu->auteur->prenom ?? 'Auteur' }} {{ $contenu->auteur->nom ?? '' }}</span>
                    </div>
                    <span><i class="fas fa-calendar me-1"></i> {{ $contenu->date_creation->format('d/m/Y à H:i') }}</span>
                    <span><i class="fas fa-map-marker-alt me-1"></i> {{ $contenu->region->nom_region ?? 'Non spécifié' }}</span>
                    <span><i class="fas fa-comments me-1"></i> <span id="commentCount">{{ $contenu->commentaires->count() }}</span> commentaires</span>
                </div>
            </div>

            <!-- Image principale -->
            @if($contenu->medias->isNotEmpty())
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $contenu->medias->first()->chemin) }}"
                         alt="{{ $contenu->titre }}"
                         class="img-fluid rounded"
                         style="max-height: 400px; width: 100%; object-fit: cover;">
                </div>
            @endif

            <!-- Contenu -->
            <article class="mb-5">
                @if($userHasAccess)
                    <div class="content-body">
                        {!! $contenu->texte !!}
                    </div>

                    <!-- Galerie de médias -->
                    @if($contenu->medias->count() > 1)
                        <div class="mt-5">
                            <h4 class="mb-3">Galerie</h4>
                            <div class="row g-3">
                                @foreach($contenu->medias->skip(1) as $media)
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $media->chemin) }}"
                                             alt="{{ $media->description }}"
                                             class="img-thumbnail"
                                             style="height: 150px; width: 100%; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Extrait pour les non-abonnés -->
                    <div class="content-preview">
                        {!! Str::limit($contenu->texte, 500) !!}
                        <div class="text-center mt-4">
                            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#abonnementModal">
                                <i class="fas fa-unlock-alt me-2"></i>Débloquer la suite
                            </button>
                        </div>
                    </div>
                @endif
            </article>

            <!-- Section commentaires -->
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="h4">
                        <i class="fas fa-comments me-2"></i>Commentaires
                        <span class="badge bg-secondary ms-2" id="commentCount">{{ $contenu->commentaires->count() }}</span>
                    </h3>
                </div>

                <!-- Formulaire de commentaire -->
                @if($userHasAccess)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Ajouter un commentaire</h5>
                            <form id="commentForm" action="{{ route('commentaires.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_contenu" value="{{ $contenu->id }}">

                                <!-- Notation -->
                                <div class="mb-3">
                                    <label class="form-label">Note</label>
                                    <div class="rating-input">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" name="note" value="{{ $i }}" id="star{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
                                            <label for="star{{ $i }}" class="star-label">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <!-- Commentaire -->
                                <div class="mb-3">
                                    <label for="texte" class="form-label">Votre commentaire</label>
                                    <textarea name="texte" id="texte" class="form-control" rows="4" placeholder="Partagez vos impressions..." required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Publier le commentaire
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Connectez-vous avec un abonnement actif pour commenter ce contenu.
                    </div>
                @endif

                <!-- Liste des commentaires -->
                <div id="commentsList">
                    @forelse($contenu->commentaires->sortByDesc('date') as $commentaire)
                        <div class="comment mb-4 pb-3 border-bottom">
                            <div class="d-flex">
                                <!-- Avatar -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $commentaire->utilisateur->photo ?? '/images/default-avatar.png' }}"
                                         alt="{{ $commentaire->utilisateur->prenom }}"
                                         class="rounded-circle" width="50">
                                </div>

                                <!-- Contenu du commentaire -->
                                <div class="flex-grow-1 ms-3">
                                    <!-- En-tête -->
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-0">{{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}</h6>
                                            <small class="text-muted">{{ $commentaire->date->format('d/m/Y à H:i') }}</small>
                                        </div>

                                        <!-- Note -->
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $commentaire->note)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>

                                    <!-- Texte du commentaire -->
                                    <p class="mb-0">{{ $commentaire->texte }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light text-center">
                            <i class="fas fa-comment-slash fa-2x mb-3 text-muted"></i>
                            <p class="mb-0">Aucun commentaire pour le moment. Soyez le premier à commenter!</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Informations sur le contenu -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong><i class="fas fa-tag me-2"></i>Type:</strong>
                            <span class="badge bg-info">{{ $contenu->typeContenu->nom ?? 'Non spécifié' }}</span>
                        </li>
                        <li class="mb-2">
                            <strong><i class="fas fa-language me-2"></i>Langue:</strong>
                            {{ $contenu->langue->nom_langue ?? 'Non spécifié' }}
                        </li>
                        <li class="mb-2">
                            <strong><i class="fas fa-globe-africa me-2"></i>Région:</strong>
                            {{ $contenu->region->nom_region ?? 'Non spécifié' }}
                        </li>
                        @if($contenu->region)
                            <li class="mb-2">
                                <strong><i class="fas fa-users me-2"></i>Population:</strong>
                                {{ number_format($contenu->region->population, 0, ',', ' ') }}
                            </li>
                            <li>
                                <strong><i class="fas fa-ruler-combined me-2"></i>Superficie:</strong>
                                {{ number_format($contenu->region->superficie, 0, ',', ' ') }} km²
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Contenus similaires -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-newspaper me-2"></i>Contenus similaires</h5>
                </div>
                <div class="card-body">
                    @php
                        $similarContents = App\Models\Contenu::where('id_region', $contenu->id_region)
                            ->where('id', '!=', $contenu->id)
                            ->where('statut', 'publié')
                            ->limit(3)
                            ->get();
                    @endphp

                    @forelse($similarContents as $similar)
                        <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <h6 class="mb-1">
                                <a href="{{ route('contenus.show', $similar->id) }}" class="text-decoration-none">
                                    {{ Str::limit($similar->titre, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>{{ $similar->date_creation->format('d/m/Y') }}
                            </small>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Aucun contenu similaire pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'abonnement (identique à l'index) -->
@include('partials.abonnement-modal')

@endsection

@push('styles')
<style>
    .rating-input {
        direction: rtl;
        unicode-bidi: bidi-override;
    }

    .rating-input input {
        display: none;
    }

    .rating-input label {
        display: inline-block;
        padding: 5px;
        font-size: 25px;
        color: #ddd;
        cursor: pointer;
    }

    .rating-input input:checked ~ label,
    .rating-input label:hover,
    .rating-input label:hover ~ label {
        color: #ffc107;
    }

    .rating {
        color: #ffc107;
    }

    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    .content-preview {
        position: relative;
        max-height: 300px;
        overflow: hidden;
    }

    .content-preview::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(to bottom, transparent, white);
    }
</style>
@endpush
