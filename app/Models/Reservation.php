<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'quantity',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
}
