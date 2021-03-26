<?php

namespace App\Services;

use App\Dictionaries\Record\SourcesDictionary;
use App\Models\Record;
use App\Repository\Record\RecordCacheRepository;
use App\Repository\Record\RecordEloquentRepository;
use App\Repository\Record\RecordExcelRepository;
use App\Repository\Record\RecordJsonRepository;
use Illuminate\Support\Collection;

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


    /**
     * Get listing of records from selected source
     *
     * @param $source
     * @return Collection
     * @throws \Exception
     */
    public function list($source)
    {
        switch ($source) {
            case SourcesDictionary::SOURCE_XLSX:
                return $this->recordExcelRepository->get();
            case SourcesDictionary::SOURCE_DATABASE:
                return $this->recordEloquentRepository->get();
            case SourcesDictionary::SOURCE_JSON:
                return $this->recordJsonRepository->get();
            case SourcesDictionary::SOURCE_CACHE:
                return $this->recordCacheRepository->get();
            default:
                throw new \Exception('Wrong data source (IMPOSSIBLE)');
        }
    }


    /**
     * Create new record and save into selected source
     *
     * @param $source
     * @param $attributes
     * @return Record
     * @throws \Exception
     */
    public function create($source, $attributes)
    {
        switch ($source) {
            case SourcesDictionary::SOURCE_XLSX:
                return $this->recordExcelRepository->create($attributes);
            case SourcesDictionary::SOURCE_DATABASE:
                return $this->recordEloquentRepository->create($attributes);
            case SourcesDictionary::SOURCE_JSON:
                return $this->recordJsonRepository->create($attributes);
            case SourcesDictionary::SOURCE_CACHE:
                return $this->recordCacheRepository->create($attributes);
            default:
                throw new \Exception('Wrong data source (IMPOSSIBLE)');
        }
    }


}


