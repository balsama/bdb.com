<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/Helpers.php';

use Symfony\Component\Filesystem\Filesystem;
use Bdb\Helpers;

$fs = new Filesystem();
$defaultSettingsPath = __DIR__ . '/../web/sites/default';

$fs->copy(
    __DIR__ . '/../fixtures/' . Helpers::FIXTURE_NAME,
    $defaultSettingsPath . '/databases/' . Helpers::FIXTURE_NAME,
);

echo "Current directory:\n";
echo __DIR__;

$fs->copy(
    $defaultSettingsPath . '/default.settings.fixturedb.php',
    $defaultSettingsPath . '/settings.fixturedb.php',
);
