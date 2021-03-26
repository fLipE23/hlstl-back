<?php


namespace App\Repository\Record;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class RecordJsonRepository extends AbstractRecordRepositoryWithCollection
{

    protected string $disk;
    protected string $filename;


    public function __construct()
    {
        $this->disk = config('domain.record.sources.json.disk');
        $this->filename = config('domain.record.sources.json.filename');
    }


    /**
     * Load data from file
     */
    protected function loadData()
    {
        if (empty($this->data)) {
            try {
                $this->data = collect(json_decode(Storage::disk($this->disk)->get($this->filename)));
            } catch (FileNotFoundException $e) {
                // file does not created yet
                $this->data = collect([]);
            }
        }
    }


    /**
     * Saving json-file
     */
    protected function saveData()
    {
        $this->loadData();

        try {
            Storage::disk($this->disk)->copy($this->filename, $this->filename .'.copy');
        } catch (\League\Flysystem\FileNotFoundException $e) {
            // do nothing if file just not created yet
        }

        Storage::disk($this->disk)->put($this->filename, json_encode($this->data));

        Storage::disk($this->disk)->delete($this->filename .'.copy');
    }

}
