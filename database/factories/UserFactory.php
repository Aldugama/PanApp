<?php

use Faker\Generator as Faker;


$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('1234'),
        'role_id' => \App\Role::all()->random()->id,
        'remember_token' => str_random(10),
    ];
});
