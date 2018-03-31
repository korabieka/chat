<?php

namespace App\Http\Controllers;

use App\Http\Services\{UserService,ChatService};
use Illuminate\Http\Request;

/**
* This is our chat controller class
*
* @author     Hussien Ashour
* @version    1
* ...
*/
class ChatController extends Controller
{
    private $chatService;

    public function __construct(ChatService $chatService)
    {
    	$this->chatService = $chatService;
    }

    /**
    * This function for saving the message
    * @param Request $request
    */
    public function saveMessage(Request $request)
    {
        $chat = $this->chatService->saveMessage($request->data);

        echo json_encode($chat);
    }

    /**
    * This function for getting chat between two users
    * @param Request $request
    */
    public function getChat(Request $request)
    {
        $chat = $this->chatService->getChat($request->data);

        echo json_encode($chat);
    }

    /**
    * This function for getting the last message between two users
    * @param Request $request
    */
    public function getLatestMsg(Request $request)
    {
        $data = ChatService::getLatestMsg($request->data);

        echo $data;
    }
}
