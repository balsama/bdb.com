<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/Helpers.php';

use Symfony\Component\Filesystem\Filesystem;
use Bdb\Helpers;
$fs = new Filesystem();

$defaultSettingsPath = __DIR__ . '/../web/sites/default';

$databaseFile = $defaultSettingsPath . '/databases/' . Helpers::FIXTURE_NAME;
$fs->remove($databaseFile);

$emptyDatabaseSettingsFileName = '/settings.fixturedb.php';
$fs->remove($defaultSettingsPath . $emptyDatabaseSettingsFileName);
