<?php

use Faker\Generator as Faker;


$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(['activo','pendiente','cancelado']),
        'date_exp' => $faker->dateTimeThisYear('now'),
        'user_id' => 2
    ];
});