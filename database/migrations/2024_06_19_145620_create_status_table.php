<?php

use App\Models\Status;
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
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->timestamps();
        });
        Schema::table('reservation', function (Blueprint $table) {
            $table->foreignIdFor(Status::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation', function (Blueprint $table) {
            $table->dropForeignIdFor(Status::class);
        });
        Schema::dropIfExists('status');
    }
};
