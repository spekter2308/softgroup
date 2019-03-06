<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {

	$title = $faker->sentence(rand(3, 8), true);
	$txt = $faker->realText(rand(1000, 4000));
	$isPublished = rand(1, 5) > 1;

	$createdAt = $faker->dateTimeBetween('-3 month', '-2 mouth');

	$data = [
		'user_id' => rand(1, 3),
		'title' => $title,
		'slug' => str_slug($title),
		'excerpt' => $faker->text(rand(150, 180)),
		'content_row' => $txt,
		'content_html' => $txt,
		'is_published' => $isPublished,
		'published_at' => $isPublished ? $faker->dateTimeBetween('-2 month', '-1 days') : null,
		'cover_image' => 'no_image.jpg',
		'created_at' => $createdAt,
		'updated_at' => $createdAt,
	];

	return $data;
});
