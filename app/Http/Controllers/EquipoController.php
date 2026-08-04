<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    public function storeAjax(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'tipo_equipo' => 'required',
            'marca' => 'required',
        ]);

        $equipo = Equipo::create($request->all());

        return response()->json([
            'success' => true,
            'equipo' => $equipo,
            'mensaje' => '¡Equipo registrado con éxito!'
        ]);
    }
}