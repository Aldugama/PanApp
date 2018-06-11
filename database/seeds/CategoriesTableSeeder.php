<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias_json = '[
            { "id": 0, "nombre": "PAN" },
            { "id": 1, "nombre": "BIZCOCHOS" },
            { "id": 2, "nombre": "ROLLOS Y FRITOS CASEROS" },
            { "id": 3, "nombre": "MAGDALENAS" },
            { "id": 4, "nombre": "EMPANADAS Y EMPANADILLAS" },
            { "id": 5, "nombre": "CROISSANTS" },
            { "id": 6, "nombre": "BOLLERIA DULCE" },
            { "id": 7, "nombre": "PALMERAS Y HOJALDRES DULCE" },
            { "id": 8, "nombre": "TORTAS" },
            { "id": 9, "nombre": "HOJALDRE Y BOLLERIA SALADA" },
            { "id": 10, "nombre": "BOCADILLOS" },
            { "id": 11, "nombre": "MIGUELITOS" },
            { "id": 12, "nombre": "PASTELERIA" },
            { "id": 13, "nombre": "ALIMENTACION" },
            { "id": 14, "nombre": "MANTECADOS DE NAVIDAD" },
            { "id": 15, "nombre": "ROSCONES" },
            { "id": 16, "nombre": "MONAS" }
            ]';


        $categorias = []; 
        $categorias = json_decode($categorias_json, true);
        for ($i = 0; $i < count($categorias); $i++)
        {
            $nombre = strtolower($categorias[$i]["nombre"]);
            $categoria=new Category();
            $categoria->name = ucfirst($nombre);
            $categoria->save();
        }

        $bebida = new Category();
        $bebida->name = 'Bebida';
        $bebida->save();

    }
}