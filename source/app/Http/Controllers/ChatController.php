<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Http\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private $chatService;

    public function __construct(ChatService $chatService)
    {
    	$this->chatService = $chatService;
    }

    public function saveMessage(Request $request)
    {
        $chat = $this->chatService->saveMessage($request->data);

        echo json_encode($chat);
    }

    public function getChat(Request $request)
    {
        $chat = $this->chatService->getChat($request->data);

        echo json_encode($chat);
    }

    public function getLatestMsg(Request $request)
    {
        $data = ChatService::getLatestMsg($request->data);

        echo $data;
    }
}
