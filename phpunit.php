<?php

error_reporting(E_ALL);

$autoloader = __DIR__ . '/vendor/autoload.php';
if (! file_exists($autoloader)) {
    echo "Composer autoloader not found: $autoloader" . PHP_EOL;
    echo "Please issue 'composer install' and try again." . PHP_EOL;
    exit(1);
}
require $autoloader;

// Fix argv for CodeIgniter
$_SERVER['argv'] = [
    'cli',
];
$_SERVER['argc'] = 1;

// Install libraries/Twig.php
$path = dirname(__FILE__) .'/vendor/codeigniter/framework/application/libraries/Twig.php';
copy('libraries/Twig.php', $path);

$contents = file_get_contents($path);
$lines = explode("\n", $contents);
unset($lines[2]);
$new_contents = implode("\n", $lines);
file_put_contents($path, $new_contents);

require __DIR__ . '/ci_instance.php';

// Load helper class for testing
require __DIR__ . '/tests/ReflectionHelper.php';
