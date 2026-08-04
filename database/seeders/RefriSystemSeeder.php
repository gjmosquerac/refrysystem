<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\InventarioRepuesto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RefriSystemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear un usuario técnico por defecto
        $tecnico = User::firstOrCreate(
            ['email' => 'tecnico@refrisystem.com'],
            [
                'name' => 'Técnico de Campo',
                'password' => Hash::make('12345678')
            ]
        );

        // 2. Crear Clientes de prueba
        $cliente1 = Cliente::create([
            'nombre' => 'Comercial La Coromoto',
            'telefono' => '04121234567',
            'correo' => 'coromoto@gmail.com',
            'direccion' => 'Av. Principal de Guacara, Local 4'
        ]);

        $cliente2 = Cliente::create([
            'nombre' => 'Residencias Parque Guacara',
            'telefono' => '04149876543',
            'correo' => 'parqueguacara@gmail.com',
            'direccion' => 'Urbanización La Floresta'
        ]);

        // 3. Crear Equipos asociados a esos clientes
        Equipo::create([
            'cliente_id' => $cliente1->id,
            'tipo_equipo' => 'Cava Cuarto',
            'marca' => 'Carrier',
            'modelo' => 'CC-500',
            'serial' => 'CAR-99882',
            'refrigerante' => 'R-404A',
            'ubicacion_especifica' => 'Área de carnicería'
        ]);

        Equipo::create([
            'cliente_id' => $cliente2->id,
            'tipo_equipo' => 'Split',
            'marca' => 'Haier',
            'modelo' => 'HS-12INVERTER',
            'serial' => 'HAI-11223',
            'refrigerante' => 'R-32',
            'ubicacion_especifica' => 'Oficina de administración piso 2'
        ]);

        // 4. Crear Repuestos en el Inventario
        InventarioRepuesto::create([
            'nombre_repuesto' => 'Gas Refrigerante R-410A (Kg)',
            'codigo' => 'GAS-410',
            'stock_actual' => 12.50,
            'unidad_medida' => 'Kilogramos',
            'precio_unitario' => 15.00
        ]);

        InventarioRepuesto::create([
            'nombre_repuesto' => 'Capacitor Doble 35/5 µF',
            'codigo' => 'CAP-35-5',
            'stock_actual' => 8.00,
            'unidad_medida' => 'Unidades',
            'precio_unitario' => 12.00
        ]);
    }
}