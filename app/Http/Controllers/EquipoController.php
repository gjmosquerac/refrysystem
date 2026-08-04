<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Cliente;

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

    public function storeFast(Request $request)
{
    try {
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
        ]);

        $equipo = Equipo::create([
            'cliente_id' => $cliente->id,
            'tipo_equipo' => $request->tipo_equipo,
            'marca' => $request->marca,
        ]);

        return response()->json([
            'success' => true,
            'cliente' => $cliente,
            'equipo' => $equipo
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
    
}