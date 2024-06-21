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
        {Schema::table('reservation', function (Blueprint $table) {
            // Ajout de la colonne stock_id
            $table->unsignedBigInteger('collection_id')->nullable();

            // Ajout de la contrainte de clé étrangère
            $table->foreign('collection_id')->references('id')->on('collection')->onDelete('cascade');
        });
        }}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation', function (Blueprint $table) {
            // Suppression de la contrainte de clé étrangère
            $table->dropForeign(['collection_id']);

            // Suppression de la colonne stock_id
            $table->dropColumn('collection_id');
        });
    }
};
