<?php

use App\Models\Stock;
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
            $table->unsignedBigInteger('stock_id')->nullable();

            // Ajout de la contrainte de clé étrangère
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
        }}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation', function (Blueprint $table) {
            // Suppression de la contrainte de clé étrangère
            $table->dropForeign(['stock_id']);

            // Suppression de la colonne stock_id
            $table->dropColumn('stock_id');
        });
    }
};
