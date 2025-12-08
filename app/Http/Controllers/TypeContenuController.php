<?php
namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenuController extends Controller
{
    public function index()
    {
        $typesContenu = TypeContenu::withCount('contenus')->get();
        return view('types-contenu.index', compact('typesContenu'));
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        TypeContenu::create($request->all());
        return redirect()->route('types-contenu.index')->with('success', 'Type de contenu créé!');
    }

    public function update(Request $request, TypeContenu $typeContenu)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        $typeContenu->update($request->all());
        return redirect()->route('types-contenu.index')->with('success', 'Type de contenu mis à jour!');
    }

    public function destroy(TypeContenu $typeContenu)
    {
        $typeContenu->delete();
        return redirect()->route('types-contenu.index')->with('success', 'Type de contenu supprimé!');
    }
}