<?php

namespace App\Exceptions;

use Exception;

class BaseErrorException extends Exception {
    protected $code = 200;

    public static function fromErrorException($message = "올바르지 않은 요청입니다.", $code = 200) {
        return new self($message, $code);
    }

    public function render($request) {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage()
        ], $this->code);
    }
}