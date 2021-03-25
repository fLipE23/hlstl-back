<?php

namespace App\Services;

use App\Repository\Record\RecordCacheRepository;
use App\Repository\Record\RecordEloquentRepository;
use App\Repository\Record\RecordExcelRepository;
use App\Repository\Record\RecordJsonRepository;

Class RecordService extends AbstractService
{

    protected RecordEloquentRepository $recordEloquentRepository;
    protected RecordJsonRepository $recordJsonRepository;
    protected RecordExcelRepository $recordExcelRepository;
    protected RecordCacheRepository $recordCacheRepository;

    public function __construct(RecordEloquentRepository $recordEloquentRepository,
                                RecordJsonRepository $recordJsonRepository,
                                RecordExcelRepository $recordExcelRepository,
                                RecordCacheRepository $recordCacheRepository)
    {
        $this->recordEloquentRepository = $recordEloquentRepository;
        $this->recordJsonRepository = $recordJsonRepository;
        $this->recordExcelRepository = $recordExcelRepository;
        $this->recordCacheRepository = $recordCacheRepository;
    }

    public function list($source, $params = [])
    {

    }


    public function create($source, $attributes)
    {
        switch ($source) {
            case 'xlsx':
                return $this->recordExcelRepository->create($attributes);
            case 'database':
                return $this->recordEloquentRepository->create($attributes);
            case 'json':
                return $this->recordJsonRepository->create($attributes);
            case 'cache':
                return $this->recordCacheRepository->create($attributes);
            default:
                throw new \Exception('Wrong data source (IMPOSSIBLE)');
        }
    }






}


