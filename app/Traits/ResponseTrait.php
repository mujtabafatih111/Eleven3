<?php

namespace App\Traits;

use Facade\FlareClient\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

trait ResponseTrait
{

    protected $success = true;
    protected $message = 'OK';
    protected $status = 200;
    protected $data = null;
    protected $response = [];
    protected $errors = [];
    protected $error = [];
    protected $exception = [];
    protected $information = [];


    /**
     * @return JsonResponse
     */
    protected function apiResponse(): JsonResponse
    {
        $this->response['success'] = $this->success;
        $this->response['message'] = $this->message;
        $this->response['status'] = $this->status;
        if (count($this->errors) > 0) {
            $this->response['errors'] = $this->errors;
        }
        if (count($this->information) > 0) {
            $this->response['information'] = $this->information;
        }
        if ($this->data) {
            $this->response['data'] = $this->beforeResponse($this->data);
        }
        if (isset($this->error['message'])) {
            $this->response['error'] = $this->error;
        }
        return response()->json($this->response, $this->status);
    }

    protected function beforeResponse($data): array
    {
        if (!$data instanceof Collection) {
            $data = collect($data);
        }
        return array_filter($data->toArray(), function ($value) {
            return !is_null($value)
                && $value !== ''
                && $value !== []
                && $value != []
                && $value != array()
                && $value != null;
        });
    }

    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error(string $message = null, int $code, $data = null)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
