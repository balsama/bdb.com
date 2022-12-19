<?php

$settings['skip_permissions_hardening'] = true;

$databases['default']['default'] = [
    'driver' => 'sqlite',
    'database' => __DIR__ . '/databases/empty.sqlite.db',
];
