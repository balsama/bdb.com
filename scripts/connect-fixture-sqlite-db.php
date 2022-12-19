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

$fs->chown(__DIR__ . '/../web/sites', get_current_user(), true);
$fs->chown(__DIR__ . '/../web/sites/default', get_current_user(), true);
$fs->chgrp(__DIR__ . '/../web/sites', get_current_user());
$fs->chgrp(__DIR__ . '/../web/sites/default', get_current_user());
$fs->chmod(__DIR__ . '/../web/sites', 665, 000, true);
exec('ls -la ' . $defaultSettingsPath);
exec('ls -la ' . $oneup);
$fs->touch(__DIR__ . '/../web/sites/default/foo.txt');

exec('ls -la ' . $defaultSettingsPath);

$fs->copy(
    $defaultSettingsPath . '/default.settings.fixturedb.php',
    $defaultSettingsPath . '/settings.fixturedb.php',
);
