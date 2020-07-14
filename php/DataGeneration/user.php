<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/7/6 0006
 * Time: 上午 10:21
 */

require_once '../vendor/autoload.php';

$faker = Faker\Factory::create();

// generate data by accessing properties
echo $faker->name;
// 'Lucy Cechtelar';
echo $faker->address;
// "426 Jordy Lodge
// Cartwrightshire, SC 88120-6700"
echo $faker->text;

// Dolores sit sint laboriosam dolorem culpa et autem. Beatae nam sunt fugit
// et sit et mollitia sed.
// Fuga deserunt tempora facere magni omnis. Omnis quia temporibus laudantium
// sit minima sint.
