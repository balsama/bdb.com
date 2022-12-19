<?php

namespace Bdb;

class Helpers
{
    public const FIXTURE_NAME = 'fixture--2022-12-19--sanitized.sqlite.db';

    public static function getKeyValue(string $key_name): string
    {
        if (getenv($key_name)) {
            return getenv($key_name);
        }
        if (file_exists(__DIR__ . '/../keys/' . $key_name . '.keys')) {
            return file_get_contents(__DIR__ . '/../keys/' . $key_name . '.keys');
        }
        return 'NO VALUE FOUND FOR ' . $key_name;
    }
}
