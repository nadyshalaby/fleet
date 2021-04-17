<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return JSON formatted success response.
     *
     * @param array|Collection $data
     * @param string $msg
     * @param integer $status
     * @return Illuminate\Http\JsonResponse
     */
    public function success($data = [], string $msg = 'Success.', int $status = 200)
    {
        return response()->json([
            'success' => true,
            'msg' => $msg,
            'data' => $data
        ], $status);
    }

    /**
     * Return JSON formatted error response.
     *
     * @param array|Collection $data
     * @param string $msg
     * @param integer $status
     * @return Illuminate\Http\JsonResponse
     */
    public function error($data = [], string $msg = 'Error.', int $status = 404)
    {
        return response()->json([
            'success' => false,
            'msg' => $msg,
            'data' => $data
        ], $status);
    }
}
