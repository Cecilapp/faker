<?php
date_default_timezone_set('Europe/Paris');

require_once 'vendor/autoload.php';

const CONTENT_DIR = 'content';

$options = getopt('c::');

if (isset($options['c'])) {
	$count = (int)$options['c'];
} else {
	$count = 10;
}

if (is_dir(CONTENT_DIR)) {
	exec('rm -rf '.CONTENT_DIR);
}
mkdir(CONTENT_DIR);

$faker = Faker\Factory::create('fr_FR');
for ($i=0; $i < $count; $i++) {
	$title = implode(' ', $faker->words(4));
	$date = $faker->date();
	$tags = '['.implode(', ', $faker->shuffle(array('un', 'deux', 'trois'))).']';
	$content = $faker->text(400);

	$data = '---'."\n"
		.'title: '.$title."\n"
		.'date: '.$date."\n"
		.'layout: index'."\n"
		.'tags: '.$tags."\n"
		.'---'."\n"
		.$content."\n";

	file_put_contents(CONTENT_DIR."/$title.md", $data);
	echo '.';
}

// time
printf("\nTime: %s seconds\n", round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 2));
