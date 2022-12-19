<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/Helpers.php';

use Symfony\Component\Filesystem\Filesystem;
use Bdb\Helpers;

$fs = new Filesystem();

$fs->copy(
    __DIR__ . '/../fixtures/' . Helpers::FIXTURE_NAME,
    __DIR__ . '/../web/sites/default/databases/' . Helpers::FIXTURE_NAME,
);

$fs->copy(
    __DIR__ . '/../web/sites/default/default.settings.fixturedb.php',
    __DIR__ . '/../web/sites/default/settings.fixturedb.php',
);
