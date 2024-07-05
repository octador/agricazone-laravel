<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';
    protected $fillable = ['id', 'description', 'adress', 'postalcode', 'city'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

}
