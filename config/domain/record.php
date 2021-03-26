<?php

use App\Dictionaries\Record\SourcesDictionary;

return [

    'sources' => [
        SourcesDictionary::SOURCE_DATABASE => [

        ],
        SourcesDictionary::SOURCE_JSON => [
            'disk' => 'json_storage',
            'filename' => 'records.json',
        ],
        SourcesDictionary::SOURCE_CACHE => [

        ],
        SourcesDictionary::SOURCE_XLSX => [
            'disk' => 'xlsx_storage',
            'filename' => 'records.xlsx',
        ],
    ],


];


