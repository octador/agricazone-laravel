<?php

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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->string('quantity');
            $table->timestamps();
        });
        Schema::table('reservation', function (Blueprint $table) {    
            $table->foreignIdFor(User::class)->constrained();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
        });
        Schema::dropIfExists('reservation');
    }
};
