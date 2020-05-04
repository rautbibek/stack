<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(rand(3,7),true),
        'votes_count'=>rand(1,10),
        'user_id' => App\User::pluck('id')->random(),
        
    ];
});
