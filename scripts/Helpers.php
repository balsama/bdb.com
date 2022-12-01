<?php

namespace Bdb;

class Helpers
{
    public static function getKeyValue(string $key_name): string
    {
        if (getenv($key_name)) {
            return $key_name;
        }
        if (file_exists(__DIR__ . '/../keys/' . $key_name . '.keys')) {
            return file_get_contents(__DIR__ . '/../keys/' . $key_name . '.keys');
        }
        return 'NO VALUE FOUND FOR ' . $key_name;
    }
}
