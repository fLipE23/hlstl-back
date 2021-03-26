<?php


namespace App\Repository\Record;

use Illuminate\Support\Facades\Cache;

class RecordCacheRepository extends AbstractRecordRepositoryWithCollection
{

    const CACHE_DATA_KEY = 'records_storage';


    protected function loadData()
    {
        $this->data = Cache::get(self::CACHE_DATA_KEY, function () {
            return collect([]);
        });
    }

    protected function saveData()
    {
        Cache::rememberForever(self::CACHE_DATA_KEY, function () {
            return $this->data;
        });
    }

}
