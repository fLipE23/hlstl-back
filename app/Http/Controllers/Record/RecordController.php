<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Requests\Record\CreateRecordRequest;
use App\Http\Requests\Record\ListingRecordsRequest;
use App\Services\RecordService;

class RecordController extends Controller
{

    protected RecordService $service;

    public function __construct(RecordService $recordService)
    {
        $this->service = $recordService;
        $this->middleware('auth:api')->except('index');
    }


    /**
     * @OA\Get(
     *   summary="Display listing of records",
     *   description="",
     *   tags={"Records"},
     *   path="/api/records?source={source}",
     *   security={{"jwt": {"*"}}},
     *   @OA\Parameter(
     *     description="Name of source",
     *     in="path",
     *     name="source",
     *     required=false,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Returns records list",
     *     @OA\JsonContent()
     *   )
     * )
     */
    public function index(ListingRecordsRequest $request)
    {
        return $this->service->list($request->input('source'));
    }


    /**
     * @OA\Post(
     *   summary="Save new record into selected source",
     *   description="",
     *   tags={"Records"},
     *   path="/api/records",
     *   security={{"jwt": {"*"}}},
     *   @OA\RequestBody(
     *       required=true,
     *       description="Record data",
     *       @OA\JsonContent(ref="#/components/schemas/CreateRecordRequest")
     *   ),
     *   @OA\Response(
     *       response=201,
     *       description="Returns new record",
     *       @OA\JsonContent()
     *   )
     * )
     */
    public function store(CreateRecordRequest $request)
    {
        $record = $this->service->create($request->input('source'), $request->only(['name', 'phone', 'email']));
        return response()->json($record, 201);
    }

}
