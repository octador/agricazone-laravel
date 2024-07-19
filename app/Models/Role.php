<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['id', 'state'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    /**
     * Méthode pour obtenir les options de rôle sous forme de tableau clé-valeur (admin)
     *
     * @return array
     */
    public static function getRoleOptions(): array
    {
        return self::pluck('state', 'id')->toArray();
    }
}
