<?php
// ...existing code...


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Langue;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $langues = Langue::all();
        $roles = Role::all();

        // la vue existante est resources/views/users/create.blade.php
        return view('users.create', compact('langues', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'mot_de_passe' => ['required', 'confirmed', Password::defaults()],
            'id_langue' => ['nullable', 'exists:langues,id'],
            'id_role' => ['nullable', 'exists:roles,id'],
            'sexe' => ['nullable', 'in:M,F'],
            'date_naissance' => ['nullable', 'date'],
            'statut' => ['nullable', 'in:actif,inactif,en_attente'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $user = User::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'mot_de_passe' => Hash::make($request->input('mot_de_passe')),
            'id_langue' => $request->input('id_langue'),
            'id_role' => $request->input('id_role'),
            'sexe' => $request->input('sexe'),
            'date_naissance' => $request->input('date_naissance'),
            'statut' => $request->input('statut') ?? 'en_attente',
            'photo' => $photoPath,
        ]);

        event(new Registered($user));

        // Pour inscription publique : login et redirection vers la route de succès
        Auth::login($user);

        return redirect()->route('register.success');
    }

    public function success()
    {
        return view('auth.register-success');
    }
}
