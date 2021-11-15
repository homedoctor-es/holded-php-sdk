<?php

/**
 * Part of the Holded package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Holded
 * @version    1.0.0
 * @author     Juan Solá
 * @license    BSD License (3-clause)
 * @copyright (c) 2021, Homedoctor Smart Medicine
 */

namespace Homedoctor\Holded\Exception;

use GuzzleHttp\Exception\ClientException;

class Handler
{

    /**
     * List of mapped exceptions and their corresponding error types.
     *
     * @var array
     */
    protected $exceptionsByErrorType = [
    ];

    /**
     * List of mapped exceptions and their corresponding status codes.
     *
     * @var array
     */
    protected $exceptionsByStatusCode = [
        // Often missing a required parameter
        400 => 'BadRequest',
        // Invalid Holded API key provided
        401 => 'Unauthorized',
        // Parameters were valid but request failed
        402 => 'InvalidRequest',
        // The requested item doesn't exist
        404 => 'NotFound',
        // Something went wrong on Holded's end
        500 => 'ServerError',
        502 => 'ServerError',
        503 => 'ServerError',
        504 => 'ServerError',
    ];

    /**
     * Constructor.
     *
     * @param  \GuzzleHttp\Exception\ClientException  $exception
     * @return void
     * @throws HoldedApiException
     */
    public function __construct(ClientException $exception)
    {
        $response = $exception->getResponse();

        $statusCode = $response->getStatusCode();

        $rawOutput = json_decode($response->getBody(true), true);

        $error = $rawOutput['error'] ?? [];

        $errorCode = $error['code'] ?? null;

        $errorType = $error['type'] ?? null;

        $message = $error['message'] ?? null;

        $missingParameter = $error['param'] ?? null;

        $this->handleException(
                $message, $statusCode, $errorType, $errorCode, $missingParameter, $rawOutput
        );
    }

    /**
     * Guesses the FQN of the exception to be thrown.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @param  string  $errorType
     * @param  string  $errorCode
     * @param  string  $missingParameter
     * @return void
     * @throws HoldedApiException
     */
    protected function handleException($message, $statusCode, $errorType, $errorCode, $missingParameter, $rawOutput)
    {
        if ($statusCode === 400 && $errorCode === 'rate_limit') {
            $class = 'ApiLimitExceeded';
        } elseif ($statusCode === 400 && $errorType === 'invalid_request_error') {
            $class = 'MissingParameter';
        } elseif (array_key_exists($errorType, $this->exceptionsByErrorType)) {
            $class = $this->exceptionsByErrorType[$errorType];
        } elseif (array_key_exists($statusCode, $this->exceptionsByStatusCode)) {
            $class = $this->exceptionsByStatusCode[$statusCode];
        } else {
            $class = 'Holded';
        }

        $class = "\\Homedoctor\\Holded\\Exception\\{$class}Exception";

        $instance = new $class($message, $statusCode);

        $instance->setErrorCode($errorCode);
        $instance->setErrorType($errorType);
        $instance->setMissingParameter($missingParameter);
        $instance->setRawOutput($rawOutput);

        throw $instance;
    }

}
