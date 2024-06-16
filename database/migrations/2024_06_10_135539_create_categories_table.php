<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeignIdFor(Category::class); // Suppression de la clé étrangère pour Category::class);
        });
        Schema::dropIfExists('category');
    }
}
