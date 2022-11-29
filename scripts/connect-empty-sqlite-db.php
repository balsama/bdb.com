<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Filesystem\Filesystem;
$fs = new Filesystem();

$defaultSettingsPath = __DIR__ . '/../web/sites/default';

$databaseFile = $defaultSettingsPath . '/databases/empty.sqlite.db';
$fs->remove($databaseFile);
$fs->touch($databaseFile);

$emptyDatabaseDefaultSettingsFileName = '/default.settings.emptydb.php';
$emptyDatabaseSettingsFileName = '/settings.emptydb.php';
$fs->copy(
    $defaultSettingsPath . $emptyDatabaseDefaultSettingsFileName,
    $defaultSettingsPath . $emptyDatabaseSettingsFileName
);
