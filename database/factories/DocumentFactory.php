<?php

use Faker\Generator as Faker;

$factory->define(App\Document::class, function (Faker $faker) {
    return [
        'title' => substr($faker->sentence(2), 0, -1),
        'id' => $faker->id,
        'name' => $faker->name,
    ];
});
