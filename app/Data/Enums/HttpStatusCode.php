<?php

namespace App\Data\Entities;

/**
 * Class HttpStatusCode
 * @package App\Models\Enums
 * https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
 */
abstract class HttpStatusCode
{
    const OK = 200;
    const CREATE = 201;
    const NO_CONTENT = 204;

    // set error code
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const CONFLICT = 409;
    const METHOD_FAILURE = 420;
    const UNPROCESSABLE_ENTITY = 422;


    // server errors
    const INTERNAL_SERVER_ERROR = 500;
    const BAD_GATEWAY = 502;
}