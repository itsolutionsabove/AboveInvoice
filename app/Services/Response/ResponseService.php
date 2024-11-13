<?php

namespace App\Services\Response;

use Illuminate\Http\JsonResponse;
use Livewire\Features\SupportRedirects\Redirector;

class ResponseService
{

    public static function json(object|array $response): JsonResponse
    {
        return response()->json($response);
    }

    // public static function jsonError(mixed $response): JsonResponse
    // {
    //     $response = ['pass' => false, 'message' => $response];
    //     return response()->json($response);
    // }
    public static function jsonError(mixed $response, int $statusCode = 400): JsonResponse
{
    $response = ['pass' => false, 'message' => $response];
    return response()->json($response, $statusCode);
}

    public static function jsonSuccess(mixed $response, $reload = false, $redirect = null): JsonResponse
    {
        $response = ['pass' => true, 'message' => $response, 'reload' => $reload, 'redirect' => $redirect];
        return response()->json($response);
    }

    public static function jsonData(mixed $response, $message = null, $reload = false, $redirect = null): JsonResponse
    {
        $response = ['pass' => true, 'message' => $message, 'data' => $response];
        return response()->json($response);
    }

    public static function jsonPass(mixed $response): JsonResponse
    {
        $response = ['pass' => true, 'message' => $response];
        return response()->json($response);
    }

    public static function redirect($path): Redirector
    {
        return redirect()->to($path);
    }

    public static function flash($message, $type = "error"): void
    {
        session()->flash($type, $message);
    }

}
