<?php

namespace Bdb;

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/Helpers.php';

use Symfony\Component\Filesystem\Filesystem;
$fs = new Filesystem();
$keys_dir = __DIR__ . '/../keys/';

$keys = [
    'SITE_EMAIL',
    'SMTP_PASSWORD',
    'AWS_ACCESS_KEY',
    'AWS_SECRET_KEY',
    'RECAPTCHA_V3_SECRET',
];

foreach ($keys as $key) {
    $value = Helpers::getKeyValue($key);
    if ($fs->exists($keys_dir . $key . '.keys')) {
        $fs->copy($keys_dir . $key . '.keys', $keys_dir . $key . '.keys.bak');
        $fs->remove($keys_dir . $key . '.keys');
    }
    $fs->touch($keys_dir . $key . '.keys');
    $fs->appendToFile($keys_dir . $key . '.keys', $value);
}
