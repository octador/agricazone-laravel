<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_available')->default(true);
            $table->integer('quantity');
            $table->float('price');
            $table->timestamps(); // Ajout des timestamps si nécessaire
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);  
       });
        Schema::dropIfExists('stocks');
    }
};
