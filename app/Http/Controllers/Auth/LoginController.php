<?php
// ...existing code...


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $validated = $request->validate([
        'email' => ['required', 'email'],
        'mot_de_passe' => ['required', 'string'],
    ]);

    if (! Auth::attempt([
        'email' => $validated['email'],
        'password' => $validated['mot_de_passe'],
    ], $request->boolean('remember'))) {

        throw ValidationException::withMessages([
            'email' => __('Les identifiants fournis ne correspondent pas à nos enregistrements.'),
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // 🔥 REDIRECTION CLAIRE PAR RÔLE
    if ($user->id_role == 1) {
        return redirect('/home-auth');
    }

    if ($user->id_role == 2) {
        return redirect()->route('dashboard');
    }

    // Sécurité
    Auth::logout();
    return redirect('/login');
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
