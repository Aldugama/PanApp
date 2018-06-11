<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(RoleTableSeeder::class);
        factory(App\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => \App\Role::ADMIN
        ]);
        factory(App\User::class, 1)->create([
            'name' => 'tienda',
            'email' => 'tienda@tienda.com',
            'role_id' => \App\Role::TIENDA
        ]);
        factory(App\User::class, 1)->create([
            'name' => 'horno',
            'email' => 'horno@horno.com',
            'role_id' => \App\Role::HORNO
        ]);
        factory(App\User::class, 10)->create();
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        factory('App\Order', 10)->create();
        factory('App\OrderProduct', 50)->create();
    }
}
