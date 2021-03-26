<?php


namespace App\Repository\Record;


use Box\Spout\Common\Exception\IOException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class RecordExcelRepository extends AbstractRecordRepositoryWithCollection
{

    protected FastExcel $fastExcel;
    protected string $path;

    public function __construct(FastExcel $fastExcel)
    {
        $this->fastExcel = $fastExcel;
        $this->path = Storage::disk(config('domain.record.sources.xlsx.disk'))
                             ->path(config('domain.record.sources.xlsx.filename'));
    }


    protected function loadData()
    {
        if (empty($this->data)) {

            try {
                $this->data = $this->fastExcel->import($this->path);
            } catch (IOException $e) {
                // file just not created yet
                if (!Str::contains($e->getMessage(), 'File does not exist')) {
                    throw $e;
                }
                $this->data = collect([]);
            }
        }
    }


    protected function saveData()
    {
        $this->loadData();

        $this->fastExcel->data($this->data)->export($this->path);
    }


}
