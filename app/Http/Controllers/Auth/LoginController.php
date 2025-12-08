<?php
// ...existing code...


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'mot_de_passe' => ['required', 'string'],
    ]);

    // Auth::attempt attend la clé 'password' — on mappe mot_de_passe vers password
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('mot_de_passe'),
    ];

    $remember = $request->boolean('remember', false);

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Redirection basée sur id_role
        if ($user->id_role == 1) {
            // Admin - id_role = 1
            return redirect()->intended('/home-auth');
        } elseif ($user->id_role == 2) {
            // Utilisateur normal - id_role = 2
            return redirect()->intended(route('users.index'));
        } else {
            // Par défaut pour d'autres rôles
            return redirect()->intended('/dashboard');
        }
    }

    throw ValidationException::withMessages([
        'email' => __('Les identifiants fournis ne correspondent pas à nos enregistrements.'),
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
