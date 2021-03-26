<?php


namespace App\Dictionaries\Record;


final class SourcesDictionary
{
    const SOURCE_DATABASE = 'database';
    const SOURCE_JSON = 'json';
    const SOURCE_CACHE = 'cache';
    const SOURCE_XLSX = 'xlsx';

    public static function availableSources() {
        return [
            self::SOURCE_DATABASE,
            self::SOURCE_JSON,
            self::SOURCE_CACHE,
            self::SOURCE_XLSX,
        ];
    }

}
