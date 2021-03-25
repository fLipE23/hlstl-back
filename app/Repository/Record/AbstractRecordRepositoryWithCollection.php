<?php


namespace App\Repository\Record;


use App\Models\Record;
use App\Repository\Repository;
use Illuminate\Support\Collection;

abstract class AbstractRecordRepositoryWithCollection implements Repository
{

    protected Collection $data;

    public function get()
    {
        $this->loadData();
        return $this->data;
    }

    public function create($attributes)
    {
        $this->loadData();

        $record = new Record($attributes);
        $this->data->push($record);

        $this->saveData();

        return $record;
    }


}
