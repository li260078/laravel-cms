<?php

use Faker\Generator as Faker;

$factory->define(App\Followres::class, function (Faker $faker) {
    return [
        'user_id'=>mt_rand(1,20),
        'following_id'=>mt_rand(1,5),
    ];
});
