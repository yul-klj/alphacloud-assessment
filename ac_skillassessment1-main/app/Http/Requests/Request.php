<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * App\Http\Requests
 *
 * @package App\Http\Requests
 */
abstract class Request extends FormRequest
{
    /**
     * Failed Validation
     *
     * @param Validator $validator validator
     * @throws UnprocessableEntityHttpException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = app(Controller::class)->errorRespond(
            $validator->errors()->toArray()
        );
        throw new HttpResponseException($response);
    }

}
