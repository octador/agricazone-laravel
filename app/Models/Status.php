<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses'; 
    protected $fillable = ['id','state'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
