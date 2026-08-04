<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioRepuesto extends Model
{
    protected $table = 'inventario_repuestos';
    protected $guarded = ['id'];

    public function ordenes() {
        return $this->belongsToMany(OrdenServicio::class, 'orden_repuesto', 'inventario_repuesto_id', 'orden_servicio_id')
                    ->withPivot('cantidad_utilizada');
    }
}