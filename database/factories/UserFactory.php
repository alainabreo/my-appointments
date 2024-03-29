<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'password' => bcrypt('123456'),

        //'avatar' => $faker->imageUrl($width = 800, $height = 800),
        'avatar' => 'avatar.png',
        'dni' => $faker->randomNumber(8, true),

        'phone' => $faker->phoneNumber,
        'mobile' => $faker->e164PhoneNumber,

        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
        'postcode' => $faker->postcode,

        'role' => $faker->randomElement(['patient', 'doctor']),

        'aboutme' => $faker->text,

        'active' => True,
        'remember_token' => Str::random(10),
    ];
});

$factory->state(App\User::class, 'patient', [
    'role' => 'patient'
]);

$factory->state(App\User::class, 'doctor', [
    'role' => 'doctor',
    'interval' => 30
]);
