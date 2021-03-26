<?php

/**
 * @OA\Info(
 *      title="Test project",
 *      version="1.0.0",
 *      @OA\Contact(
 *          email="prcelsus@gmail.com"
 *      )
 * )
 */


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
