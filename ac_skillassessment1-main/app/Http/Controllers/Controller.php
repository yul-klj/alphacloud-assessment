<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $statusCode = Response::HTTP_ACCEPTED;

    /**
     * Respond
     *
     * @param array $data    data
     * @param null  $message message
     *
     * @return \Illuminate\Http\Response
     */
    public function successRespond(
        $data = [],
        $message = 'Success',
        $httpStatusCode = Response::HTTP_ACCEPTED
    ) {
        $this->statusCode = $httpStatusCode;
        $transformedSuccess['message'] = $message;
        $transformedSuccess['data'] = $data;

        return $this->respondWrapper($transformedSuccess);
    }

    /**
     * Generates a Response with a Custom HTTP header and a given message.
     *
     * @param array  $data           error response data
     * @param string $message        message
     * @param int    $httpStatusCode http status code
     * @return \Illuminate\Http\Response
     */
    public function errorRespond(
        $data = [],
        $message = 'Bad Request',
        $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY
    ) {
        $this->statusCode = $httpStatusCode;
        $transformedErr['message'] = $message;
        $transformedErr['errors'] = $data;

        return $this->respondWrapper($transformedErr);
    }

    /**
     * Responding to request by returning JSON format data
     *
     * @param array $array   array
     * @param array $headers headers
     *
     * @return \Illuminate\Http\Response
     */
    private function respondWrapper(array $array, array $headers = [])
    {
        $response = response(json_encode($array), $this->statusCode, $headers);
        $response->header('Content-Type', 'application/json');

        return $response;
    }
}
