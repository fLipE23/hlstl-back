<?php

namespace App\Repository\Record;

use App\Models\Record;
use App\Repository\Repository;

class RecordEloquentRepository implements Repository
{

    protected Record $model;

    public function __construct(Record $record)
    {
        $this->model = $record;
    }

    public function create($attributes) : Record
    {
        return $this->model->create($attributes);
    }

    public function get()
    {
        return $this->model->all();
    }


}
