<?php

use Faker\Generator as Faker;

$factory->define(App\OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween(1,10),
        'product_id' => $faker->numberBetween(1,387),
        'quantity' => $faker->numberBetween(1,100),
    ];
});
