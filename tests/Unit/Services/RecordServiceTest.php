<?php

namespace Tests\Unit\Services;

use App\Models\Record;
use App\Services\RecordService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
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

        // todo it works, need to be tested

        dd($result);

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

        // todo it works, need to be tested

        dd($result);

    }

    public function testCreateIntoCache()
    {
        $result = $this->service->create('cache', [
            'name' => $this->faker->name . ' ' . $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
        ]);

        // todo it works, need to be tested


        dd($result);

    }


}


