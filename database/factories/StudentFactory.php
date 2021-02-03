<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'alamat' => $faker->address,
        'no_hp' => $faker->phoneNumber,
        'jk' => $faker->randomElement($array = array('Laki-Laki', 'Perempuan')),
        'email' => $faker->safeEmail,
    ];
});
