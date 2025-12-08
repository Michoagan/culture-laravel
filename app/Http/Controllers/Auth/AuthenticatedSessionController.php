<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // 🎯 DEBUG CRITIQUE - À NE PAS SUPPRIMER
        Log::info('=== DÉBUT DEBUG CONNEXION ===');
        Log::info('User ID: ' . $user->id);
        Log::info('User Email: ' . $user->email);
        Log::info('User Role: ' . $user->id_role);
        Log::info('Is Admin: ' . ($user->id_role === 1 ? 'OUI' : 'NON'));
        Log::info('=== FIN DEBUG CONNEXION ===');

        // 🎯 VERSION SIMPLIFIÉE POUR TEST
        if ($user->id_role === 1) {
            Log::info('🔄 REDIRECTION VERS ADMIN DASHBOARD');
            return redirect()->route('admin.dashboard');
        } else {
            Log::info('🔄 REDIRECTION VERS HOME AUTH');
            return redirect()->route('home.auth');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
