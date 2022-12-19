<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Filesystem\Filesystem;

$fs = new Filesystem();
$defaultSettingsPath = __DIR__ . '/../web/sites/default';

$databaseFile = $defaultSettingsPath . '/databases/empty.sqlite.db';
$fs->remove($databaseFile);
$fs->touch($databaseFile);

$fs->copy(
    $defaultSettingsPath . '/default.settings.emptydb.php',
    $defaultSettingsPath . '/settings.emptydb.php',
);
