<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'stock_id',
        'image',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the stock that owns the product.
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
