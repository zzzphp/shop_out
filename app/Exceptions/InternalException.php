<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class InternalException extends Exception
{
    //
    protected $messageForUser;

    public function __construct($message = "", $code = 400, $messageForUser = "数据验证错误", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->messageForUser = $message;
    }

    public function render(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $this->messageForUser], $this->code);
        }

        return view('pages.error', ['message' => $this->messageForUser]);
    }
}
