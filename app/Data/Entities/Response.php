<?php

namespace App\Data\Entities;


class Response
{
    /**
     * @var integer $code Http Status Code
     */
    public $code;

    /**
     * @var string $message
     */
    public $message;

    /**
     * @var Error $error
     */
    public $error;

    /**
     * @var Value $value
     */
    public $value;

    public function __construct()
    {
        $this->code = HttpStatusCode::OK;
        $this->message = '';
        $this->error = new Error();
        $this->value = new Value();
    }

    public function toArray()
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'errors' => $this->error->count() ? $this->error->toArray() : null,
            'value' => $this->value->count() ? $this->value->toArray() : null
        ];
    }

    public function json()
    {
        return response()->json($this->toArray(), $this->code);
    }
}