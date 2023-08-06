<?php

namespace Mivu\Handlers;

use Exception;
use Mivu\Enums\MessageEnum;

class ApiHandlers
{
    protected const CODE_SUCCESS_RES = 200;
    protected const CODE_ERROR_RES = 400;
    protected const CODE_NOT_FOUND_RES = 404;
    protected const CODE_EXCEPTION_RES = 500;

    static function sendResponse($type, $message, $data = null, $code = self::CODE_SUCCESS_RES)
    {
        $res = [
            // 'type' => $type,
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ];

        response()->json($res, $code)->send();
        exit;
    }

    static function success($message, $code = self::CODE_SUCCESS_RES, $type = "success")
    {
        self::sendResponse($type, $message, null, $code);
    }

    static function error($message, $code = self::CODE_ERROR_RES, $type = "error")
    {
        self::sendResponse($type, $message, null, $code);
    }

    static function notFound($message, $code = self::CODE_NOT_FOUND_RES, $type = "error")
    {
        self::sendResponse($type, $message, null, $code);
    }

    static function exception(Exception $exception, $code = self::CODE_EXCEPTION_RES, $type = "error")
    {
        self::sendResponse($type, MessageEnum::error_retrieving_id . $exception->getMessage(), null, $code);
    }

    static function data($data, $message = null, $code = self::CODE_SUCCESS_RES, $type = "success")
    {
        self::sendResponse($type, $message, $data, $code);
    }

    static function condition($data, $message = null, $code = self::CODE_SUCCESS_RES, $type = "success")
    {
        $responseType = !empty($data) ? $type : 'error';
        $responseMessage = !empty($data) ? $message : MessageEnum::unavailable_id;
        $responseData = !empty($data) ? $data : null;
        $responseCode = !empty($data) ? $code : self::CODE_ERROR_RES;
        self::sendResponse($responseType, $responseMessage, $responseData, $responseCode);
    }
}
