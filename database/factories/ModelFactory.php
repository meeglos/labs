<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Task::class, function ($faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'channel_id'    =>  function () {
            return factory('App\Channel')->create()->id;
        },
        'agent_code'    =>  $faker->userName,
        'client_code'   =>  $faker->numerify('Cli#####'),
        'client_name'   =>  $faker->firstNameMale,
        'client_phone'  =>  $faker->phoneNumber,
        'description'   =>  $faker->sentence,
//        'slug'          => $slug = Str::slug($title),
//        'pending' =>    'true'
    ];
});

$factory->define(App\Channel::class, function ($faker) {
    $name = $faker->word;
//    $name = $faker->randomElement(['Mobile', 'Fixed', 'Email', 'Internet', 'Apps']);
    return [
        'name'  =>  $name,
        'slug'  =>  $name
    ];
});

$factory->define(App\Post::class, function ($faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'task_id' => function () {
            return factory('App\Task')->create()->id;
        },
        'comments'    =>  $faker->sentence,
    ];
});