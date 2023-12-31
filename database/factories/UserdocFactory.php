<?php

use Faker\Generator as Faker;

$factory->define(App\Userdoc::class, function (Faker $faker) {
    return [
        'title' => substr($faker->sentence(2), 0, -1),
        'userid' => $faker->userid,
        'document_id' => $faker->document_id,
    ];
});
