<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    protected $table = 'ordenes_servicio';
    protected $guarded = ['id'];

    public function equipo() {
        return $this->belongsTo(Equipo::class);
    }

    public function tecnico() {
        return $this->belongsTo(User::class, 'user_id');
    }
}