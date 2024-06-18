<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();
        });
	Schema::table('products',function (blueprint $table){
	$table->foreignIdFor(Category::class)->constrained();
	});
        
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeignIdFor(Category::class); // Suppression de la clé étrangère pour Category::class);
        });
        Schema::dropIfExists('categories');
    }
};
