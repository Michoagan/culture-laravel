<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Renommer 'Modérateur' en 'Utilisateur'
        DB::table('roles')
            ->where('nom', 'Modérateur')
            ->update(['nom' => 'Utilisateur']);

        // Récupérer l'ID du rôle 'Utilisateur' (anciennement Modérateur, ou créé si inexistant)
        $utilisateurRole = DB::table('roles')->where('nom', 'Utilisateur')->first();
        
        if (!$utilisateurRole) {
            // Sécurité : si le rôle n'existe pas (cas étrange), on le crée
            $id = DB::table('roles')->insertGetId(['nom' => 'Utilisateur']);
            $utilisateurRoleId = $id;
        } else {
            $utilisateurRoleId = $utilisateurRole->id;
        }

        // 2. Transférer tous les 'Contributeur' et 'Lecteur' vers 'Utilisateur'
        $rolesToDelete = DB::table('roles')->whereIn('nom', ['Contributeur', 'Lecteur'])->pluck('id');

        DB::table('users')
            ->whereIn('id_role', $rolesToDelete)
            ->update(['id_role' => $utilisateurRoleId]);

        // 3. Supprimer les anciens rôles
        DB::table('roles')->whereIn('id', $rolesToDelete)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // On recrée les rôles supprimés (mais on ne peut pas deviner qui était qui)
        DB::table('roles')->insert([
            ['nom' => 'Modérateur'], // On pourrait vouloir renommer Utilisateur -> Modérateur, mais c'est ambigu
            ['nom' => 'Contributeur'],
            ['nom' => 'Lecteur'],
        ]);
    }
};
