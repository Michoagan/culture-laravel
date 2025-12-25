<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use FedaPay\FedaPay;
use FedaPay\Transaction;

class PaiementController extends Controller
{
    /**
     * Initialiser un paiement avec FedaPay
     */
    public function initier(Request $request)
    {
        $request->validate([
            'type_abonnement' => 'required|string|in:mensuel,annuel,etudiant'
        ]);

        // Définir les prix côté serveur (Plus sécurisé)
        $prix = [
            'mensuel' => 5000,
            'annuel' => 48000,
            'etudiant' => 3000
        ];

        $montant = $prix[$request->type_abonnement];

        // Initialiser FedaPay avec votre clé
        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.mode', 'sandbox'));

        try {
            // Créer la transaction
            $transaction = Transaction::create([
                'description' => 'Abonnement ' . ucfirst($request->type_abonnement),
                'amount' => $montant,
                'currency' => ['iso' => 'XOF'],
                'callback_url' => route('paiement.callback'),
                'customer' => [
                    'firstname' => Auth::user()->prenom,
                    'lastname' => Auth::user()->nom,
                    'email' => Auth::user()->email,
                    'phone_number' => [
                        'number' => Auth::user()->telephone ?? '00000000',
                        'country' => 'bj'
                    ]
                ]
            ]);

            // Générer le token pour le paiement
            $token = $transaction->generateToken();

            // Sauvegarder la transaction temporairement
            session(['transaction_id' => $transaction->id]);
            session(['type_abonnement' => $request->type_abonnement]);

            // Rediriger vers la page de paiement FedaPay
            return redirect($token->url);

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'initialisation du paiement: ' . $e->getMessage());
        }
    }

    /**
     * Callback après paiement
     */
    public function callback(Request $request)
    {
        $transactionId = $request->input('id') ?? session('transaction_id');
        $typeAbonnement = session('type_abonnement');

        if (!$transactionId) {
            return redirect('/contenus')->with('error', 'Session de paiement invalide.');
        }

        // Vérifier le statut de la transaction
        FedaPay::setApiKey(config('services.fedapay.secret_key'));
        FedaPay::setEnvironment(config('services.fedapay.mode', 'sandbox'));

        try {
            $transaction = Transaction::retrieve($transactionId);

            if ($transaction->status === 'approved') {
                // Mettre à jour l'utilisateur
                $user = Auth::user();

                // Calculer la date d'expiration
                $expiration = now();
                if ($typeAbonnement === 'mensuel') {
                    $expiration = now()->addMonth();
                } elseif ($typeAbonnement === 'annuel') {
                    $expiration = now()->addYear();
                }

                // Mettre à jour l'abonnement
                $user->abonnement_valide = true;
                $user->date_expiration_abonnement = $expiration;
                $user->type_abonnement = $typeAbonnement;
                $user->save();

                // Nettoyer la session
                session()->forget(['transaction_id', 'type_abonnement']);

                return redirect('/contenus')->with('success', 'Paiement réussi! Votre abonnement est maintenant actif.');
            } else {
                return redirect('/contenus')->with('error', 'Paiement échoué ou annulé.');
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('FedaPay Payment Error: ' . $e->getMessage());
            return redirect('/contenus')->with('error', 'Erreur lors de la vérification du paiement: ' . $e->getMessage());
        }
    }

    // Ajoutez cette méthode dans PaiementController
public function abonnement()
{
    $user = Auth::user();

    return view('abonnement.index', [
        'user' => $user,
        'abonnementActif' => $user->abonnement_valide ?? false,
        'dateExpiration' => $user->date_expiration_abonnement ?? null
    ]);
}
}
