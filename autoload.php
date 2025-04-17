<?php

declare(strict_types=1);

use Composer\Autoload\ClassLoader;

$loader = null;

foreach (['../..', '.'] as $dir) {
    if (file_exists($file = __DIR__."/{$dir}/vendor/autoload.php")) {
        /** @var ClassLoader $loader */
        $loader = include_once $file;
        break;
    }
}

if (! $loader) {
    throw new RuntimeException(
        'Unable to find composer autoload.php.\nDid you run `composer install`?'
    );
}
