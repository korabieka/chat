<?php

namespace App\Http\Services;

use App\Http\Repositories\ChatRepository;
use Illuminate\Database\Eloquent\Collection;
/**
* This is our chat service class
*
* @author     Hussien Ashour
* @version    1
* ...
*/
class ChatService
{
	private $chatRepository;

	public function __construct(ChatRepository $chatRepository)
	{
		$this->chatRepository = $chatRepository;
	}

    /**
    * This function for saving the message
    * @param string $data
    * @return array $chat
    */
	public function saveMessage(string $data)
	{
		$data = json_decode($data);
		
		$this->chatRepository->saveMessage($data);
		
		$chat = ChatRepository::getChat($data->sender,$data->reciever);

		$chat = ChatService::buildChatMessagesArray($chat);

		return json_encode(['chat' => $chat]);
	}

    /**
    * This function for building the messages array from the chat
    * @param Chat $chat
    * @return array $chatArray
    */
	public static function buildChatMessagesArray(Collection $chat)
	{
		$chatArray = array();
		foreach ($chat as $message) {
			$chatArray[] = $message->user->name.' : '.$message->message;
		}
		return $chatArray;
	}

    /**
    * This function for getting chat between two users
    * @param string $data
    * @return array $chat
    */
	public function getChat(string $data)
	{
		$data = json_decode($data);

		$chat = ChatRepository::getChat($data->sender , $data->reciever);

		$chat = ChatService::buildChatMessagesArray($chat);

		return json_encode(['chat'=>$chat]);
	}

    /**
    * This function for getting the new messages if there is a new messages
    * @param string $data
    * @return string $chat
    */
	public static function getLatestMsg(string $data)
	{
		$data = json_decode($data);
		// check if timestamp sent in the data
		$last_ajax_call = isset($data->timestamp) ? (int)$data->timestamp : null;
		// get the last message's timestamp
		$last_created_at = ChatService::getLastCreatedAt($data->sender , $data->reciever);
		while(true) {
			/* check if the last message's timestamp is greater than the time stamp
				sent in the data or if there is not time stamp sent*/
		    if ($last_ajax_call == null || $last_created_at > $last_ajax_call) {

		    	$chat = ChatRepository::getChat($data->sender , $data->reciever);
		    	
		    	$chat = ChatService::buildChatMessagesArray($chat);

		        $result = array(
		            'chat' => $chat,
		            'timestamp' => $last_created_at
		        );

		        // encode to JSON, render the result (for AJAX)
		        $json = json_encode($result);

		        return $json; // leave this loop step
		    } else {
		        // wait for 1 sec
		        sleep( 1 );
		    }
		}
	}
    /**
    * This function for getting the last message's timestamp between two users
    * @param int $senderId
    * @param int $revcieverId
    * @return int $last_created_at
    */
	public static function getLastCreatedAt(int $senderId , int $recieverId)
	{
		$last_created_at = ChatRepository::getLastCreatedAt($senderId , $recieverId);
		if($last_created_at) {
			$last_created_at = strtotime($last_created_at);			
		} else {
			$last_created_at = 0;
		}
		return $last_created_at;
	}

    /**
    * This function for deleting the chat
    * @param int $userId
    */
	public function deleteChat($userId)
	{

		$this->chatRepository->deleteChat($userId);
	}
}