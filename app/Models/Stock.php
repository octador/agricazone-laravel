<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperStock
 */
class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $filable = ['id', 'product_id', 'quantity', 'price', 'description', 'is_available'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
