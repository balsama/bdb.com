<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Filesystem\Filesystem;
$fs = new Filesystem();

$defaultSettingsPath = __DIR__ . '/../web/sites/default';

$databaseFile = $defaultSettingsPath . '/databases/empty.sqlite.db';
$fs->remove($databaseFile);


$emptyDatabaseSettingsFileName = '/settings.emptydb.php';
$fs->remove($defaultSettingsPath . $emptyDatabaseSettingsFileName);
