<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $fillable = [
        'id',
        'quantity',
        'user_id',
        'status_id',
        'stock_id',
        'collection_id',
        'total_price'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
