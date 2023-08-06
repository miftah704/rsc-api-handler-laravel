<?php

namespace Mivu\Handlers;

use Mivu\Enums\MessageEnum;

class ResponseHandlers
{
    public static function tryCatch($response, string $variable = null, $withFail = false)
    {
        try {
            if (!$response && $withFail) ApiHandlers::notFound(MessageEnum::unavailable_id);
            if (!$variable) return $response;
            return [$variable => $response];
        } catch (\Exception $e) {
            ApiHandlers::exception($e);
        }
    }
}
