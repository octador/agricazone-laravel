<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    
    protected $fillable = ['id', 'name', 'image'];

 

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
