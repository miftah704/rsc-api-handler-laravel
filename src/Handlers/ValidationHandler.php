<?php

namespace Mivu\Handlers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @author miftah shidiq
 */
class ValidationHandler
{
    static function check($body = [])
    {
        $validator = Validator::make(Request::all(), $body);

        if ($validator->fails()) {
            ApiHandlers::error($validator->messages()->first());
        }
    }
}
