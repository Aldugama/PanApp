<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{

    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->display_name = 'Administrador de la app';
        $role->description = 'Modificar registros base de datos';
        $role->save();

        $role = new Role();
        $role->name = 'tienda';
        $role->display_name = 'Tiendas de la empresa';
        $role->description = 'Acceso a pedidos';
        $role->save();

        $role = new Role();
        $role->name = 'horno';
        $role->display_name = 'Trabajadores horno central';
        $role->description = 'Impresión de pedidos';
        $role->save();

    }
}
