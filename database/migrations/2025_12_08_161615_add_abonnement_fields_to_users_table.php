<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('abonnement_valide')->default(false)->after('id_role');
            $table->date('date_expiration_abonnement')->nullable()->after('abonnement_valide');
            $table->string('type_abonnement')->nullable()->after('date_expiration_abonnement');
            $table->string('telephone')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'abonnement_valide',
                'date_expiration_abonnement',
                'type_abonnement',
                'telephone'
            ]);
        });
    }
};
