<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $guarded = ['id'];

    public function equipos() {
        return $this->hasMany(Equipo::class);
    }
}