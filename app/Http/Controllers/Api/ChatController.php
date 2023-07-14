<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ParentController\ParentController;
use App\Http\Controllers\Controller;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;

class ChatController extends ParentController
{
    protected $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }
    public function chat(Request $request)
    {
        try {
            $chat = $this->chatRepository->chat($request->all());

            $this->status = 201;
            $this->success = true;
            $this->message = __("Message  successfully");
            $this->data = ["message" => $chat];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getMessage(Request $request)
    {
        try {
            $chat = $this->chatRepository->getMessage($request->all());

            $this->status = 201;
            $this->success = true;
            $this->message = __("Message  successfully");
            $this->data = ["message" => $chat];
            return $this->apiResponse();

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}