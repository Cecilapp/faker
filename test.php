<?php
date_default_timezone_set('Europe/Paris');

require_once 'vendor/autoload.php';

const CONTENT_DIR = 'content';

if (is_dir(CONTENT_DIR)) {
	exec('rm -rf '.CONTENT_DIR);
	mkdir(CONTENT_DIR);
}

$faker = Faker\Factory::create('fr_FR');
for ($i=0; $i < 10; $i++) {
	
	$title = implode(' ', $faker->words(4));
	$date = $faker->date();
	$tags = implode(', ', $faker->words());
	$content = $faker->text(400);
	
	$data = '---'."\n"
		.'title: '.$title."\n"
		.'date: '.$date."\n"
		.'layout: index'."\n"
		.'tags: '.$tags."\n"
		.'---'."\n"
		.$content."\n";

	file_put_contents(CONTENT_DIR."/$title.md", $data);
}
