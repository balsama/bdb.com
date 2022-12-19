<?php

include_once __DIR__ . '/../../../scripts/Helpers.php';
use Bdb\Helpers;

$databases['default']['default'] = [
    'driver' => 'sqlite',
    'database' => __DIR__ . '/databases/' . Helpers::FIXTURE_NAME,
];
