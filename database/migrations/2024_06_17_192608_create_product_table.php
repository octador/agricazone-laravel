<?php

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image'); // Ajout de la colonne image
            $table->timestamps();
        });
	 Schema::table('stocks', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->constrained();
        });
        
    }

    public function down()
    {
        Schema::dropForeignIdFor(Product::class);
        Schema::dropIfExists('products');
    }
};
