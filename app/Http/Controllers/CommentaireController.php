<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function index()
    {
        $commentaires = Commentaire::with(['utilisateur', 'contenu'])->get();
        return view('commentaires.index', compact('commentaires'));
    }

    public function create()
    {
        $contenus = Contenu::all();
        return view('commentaires.create', compact('contenus'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'texte' => 'required|string|max:1000',
            'note' => 'required|integer|min:1|max:5',
            'id_contenu' => 'required|exists:contenus,id'
        ]);

        $commentaire = Commentaire::create([
            'texte' => $request->texte,
            'note' => $request->note,
            'id_contenu' => $request->id_contenu,
            'id_utilisateur' => Auth::id(),
            'date_commentaire' => now()
        ]);

        // Recharger les relations
        $commentaire->load('utilisateur');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'commentaire' => $commentaire,
                'message' => 'Commentaire ajouté avec succès!'
            ]);
        }

        return back()->with('success', 'Commentaire ajouté avec succès!');
    }
    public function show(Commentaire $commentaire)
    {
        $commentaire->load(['utilisateur', 'contenu']);
        return view('commentaires.show', compact('commentaire'));
    }

    public function edit(Commentaire $commentaire)
    {
        $contenus = Contenu::all();
        return view('commentaires.edit', compact('commentaire', 'contenus'));
    }

    public function update(Request $request, Commentaire $commentaire)
    {
        $validatedData = $request->validate([
            'texte' => 'required|string',
            'note' => 'nullable|integer|min:1|max:5',
            'id_contenu' => 'required|exists:contenus,id',
        ]);

        $commentaire->update($validatedData);

        return redirect()->route('commentaires.index')
                        ->with('success', 'Commentaire mis à jour avec succès!');
    }

    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();
        return redirect()->route('commentaires.index')
                        ->with('success', 'Commentaire supprimé avec succès!');
    }
}
