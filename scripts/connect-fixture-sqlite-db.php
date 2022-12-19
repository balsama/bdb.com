<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/Helpers.php';

use Symfony\Component\Filesystem\Filesystem;
use Bdb\Helpers;

$fs = new Filesystem();
$defaultSettingsPath = __DIR__ . '/../web/sites/default';
$oneup = __DIR__ . '/../web/sites';

$fs->copy(
    __DIR__ . '/../fixtures/' . Helpers::FIXTURE_NAME,
    $defaultSettingsPath . '/databases/' . Helpers::FIXTURE_NAME,
);

$fs->copy(
    $defaultSettingsPath . '/default.settings.fixturedb.php',
    $defaultSettingsPath . '/settings.fixturedb.php',
);
