<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Langue;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContenuController extends Controller
{
    public function index()
    {
        // Récupération des contenus avec pagination
        $contenus = Contenu::with(['auteur', 'region', 'langue', 'typeContenu'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Données pour les filtres
        $typesContenu = TypeContenu::all();
        $regions = Region::all();
        $langues = Langue::all();

        // Statistiques
        $stats = [
            'publies' => Contenu::where('statut', 'publié')->count(),
            'brouillons' => Contenu::where('statut', 'brouillon')->count(),
            'en_attente' => Contenu::where('statut', 'en_attente')->count(),
        ];

        return view('contenus.index', compact('contenus', 'typesContenu', 'regions', 'langues', 'stats'));
    }

    // Les autres méthodes restent identiques...
    public function create()
    {
        // Récupération des listes nécessaires pour les sélecteurs du formulaire
        $typesContenu = TypeContenu::orderBy('nom')->get();
        $regions      = Region::orderBy('nom_region')->get();
        $langues      = Langue::orderBy('nom_langue')->get();

        // Retour de la vue avec les variables compactées
        return view('contenus.create', compact('typesContenu', 'regions', 'langues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'id_type_contenu' => 'required|exists:type_contenus,id',
            'id_region' => 'required|exists:regions,id',
            'id_langue' => 'required|exists:langues,id',
            'statut' => 'required'
        ]);

        // Champs gérés par le backend
        $validated['id_auteur'] = Auth::id();
        $validated['date_creation'] = now();

        Contenu::create($validated);

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu créé avec succès !');
    }


    public function show($id)
    {
        $contenu = Contenu::with([
            'typeContenu',
            'region',
            'langue',
            'medias',
            'commentaires.utilisateur',
            'auteur'
        ])->findOrFail($id);

        // Vérifier si le contenu est publié
        if ($contenu->statut !== 'publié') {
            abort(404);
        }

        // Vérifier si l'utilisateur a accès (abonné ou contenu gratuit)
        $userHasAccess = $this->checkUserAccess($contenu);

        return view('contenus.show', compact('contenu', 'userHasAccess'));
    }



    public function edit(Contenu $contenu)
    {
        $typesContenu = TypeContenu::all();
        $regions = Region::all();
        $langues = Langue::all();

        return view('contenus.edit', compact('contenu', 'typesContenu', 'regions', 'langues'));
    }

    public function update(Request $request, Contenu $contenu)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'id_type_contenu' => 'required|exists:type_contenus,id',
            'id_region' => 'required|exists:regions,id',
            'id_langue' => 'required|exists:langues,id',
            'statut' => 'required|in:brouillon,en_attente,publié,rejeté',
        ]);

        $contenu->update($validated);

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu mis à jour avec succès!');
    }

    public function destroy(Contenu $contenu)
    {
        $contenu->delete();

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu supprimé avec succès!');
    }
}
