<?php

namespace App\Exceptions;

use Exception;

class BaseErrorException extends Exception {
    protected $code = 200;

    public function render($request) {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage()
        ], $this->code);
    }
}