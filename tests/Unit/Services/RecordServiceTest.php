<?php

namespace Tests\Unit\Services;

use App\Models\Record;
use App\Repository\Record\RecordCacheRepository;
use App\Services\RecordService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;
use Tests\TestCase;


Class RecordServiceTest extends TestCase
{

    use WithFaker;

    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = app()->make(RecordService::class);
    }


    public function testCreateIntoDatabase()
    {
        $result = $this->service->create('database', [
            'name' => $this->faker->name .' '. $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
        ]);

        $records = Record::all();

        // record found
        $this->assertTrue($records->contains($result));
    }

    public function testCreateIntoJson()
    {
        $result = $this->service->create('json', [
            'name' => $this->faker->name .' '. $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
        ]);

        $this->assertInstanceOf(Record::class, $result);

        $data = collect(json_decode(
            Storage::disk(config('domain.record.sources.json.disk'))
                ->get(config('domain.record.sources.json.filename')), true
        ));

        // record found
        $this->assertTrue($data->contains($result->toArray()));
    }

    public function testCreateIntoXlsx()
    {
        $result = $this->service->create('xlsx', [
            'name' => $this->faker->name . ' ' . $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
        ]);

        $this->assertInstanceOf(Record::class, $result);

        $list = (new FastExcel)->import(Storage::disk(config('domain.record.sources.xlsx.disk'))
                                ->path(config('domain.record.sources.xlsx.filename')));

        $this->assertTrue($list->contains($result->toArray()));
    }

    public function testCreateIntoCache()
    {
        $result = $this->service->create('cache', [
            'name' => $this->faker->name . ' ' . $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
        ]);

        $list = Cache::get(RecordCacheRepository::CACHE_DATA_KEY, function () {
            return collect([]);
        });

        $this->assertTrue($list->contains($result));
    }


}


