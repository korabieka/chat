<?php

namespace App\Http\Services;

use App\Http\Repositories\ChatRepository;

class ChatService
{
	private $chatRepository;

	public function __construct(ChatRepository $chatRepository)
	{
		$this->chatRepository = $chatRepository;
	}

	public function saveMessage($data)
	{
		$data = json_decode($data);
		
		$this->chatRepository->saveMessage($data);
		
		$chat = ChatRepository::getChat($data->sender,$data->reciever);

		$chat = ChatService::buildChatMessagesArray($chat);

		return $chat;
	}

	public static function buildChatMessagesArray($chat)
	{
		$chatArray = array();
		foreach ($chat as $message) {
			$chatArray[] = $message->user->name.' : '.$message->message;
		}
		return $chatArray;
	}

	public function getChat($data)
	{
		$data = json_decode($data);
		$chat = ChatRepository::getChat($data->sender , $data->reciever);
		$chat = ChatService::buildChatMessagesArray($chat);
		return $chat;
	}

	public static function getLatestMsg($data)
	{
		$data = json_decode($data);
		$last_ajax_call = isset($data->timestamp) ? (int)$data->timestamp : null;
		$last_created_at = ChatService::getLastCreatedAt($data->sender , $data->reciever);
		while(true) {
		    if ($last_ajax_call == null || $last_created_at > $last_ajax_call) {

		    	$chat = ChatRepository::getChat($data->sender , $data->reciever);
		    	$chat = ChatService::buildChatMessagesArray($chat);

		        $result = array(
		            'chat' => $chat,
		            'timestamp' => $last_created_at
		        );
		        // encode to JSON, render the result (for AJAX)
		        $json = json_encode($result);
		        return $json;
		        // leave this loop step
		    } else {
		        // wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
		        sleep( 1 );
		    }
		}
	}

	public static function getLastCreatedAt($senderId , $recieverId)
	{
		$last_created_at = ChatRepository::getLastCreatedAt($senderId , $recieverId);
		if($last_created_at) {
			$last_created_at = strtotime($last_created_at);			
		} else {
			$last_created_at = 0;
		}
		return $last_created_at;
	}

	public function deleteChat($userId)
	{

		$this->chatRepository->deleteChat($userId);
	}
}