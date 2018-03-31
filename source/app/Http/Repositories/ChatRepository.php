<?php

namespace App\Http\Repositories;

use App\Chat;

/**
* This is our chat repository class
*
* @author     Hussien Ashour
* @version    1
* ...
*/
class ChatRepository
{

    /**
    * This function for saving the message in the database
    * @param Object $data
    * @return boolean
    */
	public function saveMessage(Object $data)
	{
			$chat = new Chat;
			$chat->message = $data->message;
			$chat->room = 'room_'.$data->sender.'_'.$data->reciever;
			$chat->user_id = $data->sender;
			$chat->save();
			return true;
	}

    /**
    * This function for getting the chat between two users in the database
    * @param int $senderId
    * @param int $revcieverId
    * @return Chat
    */
	public static function getChat(int $senderId , int $recieverId)
	{
		return Chat::where('room','room_'.$senderId.'_'.$recieverId)->orWhere('room','room_'.$recieverId.'_'.$senderId)->get();
	}

    /**
    * This function for getting the last message time between two users in the database
    * @param int $senderId
    * @param int $revcieverId
    * @return string
    */
	public static function getLastCreatedAt(int $senderId , int $recieverId)
	{
		$row = Chat::where('room','room_'.$senderId.'_'.$recieverId)->orWhere('room','room_'.$recieverId.'_'.$senderId)->orderBy('created_at','desc')->first();
		if(!$row) {
			return 0;
		}
		return $row->created_at;	
	}

    /**
    * This function for deleting the chat from the database
    * @param int $userId
    */
	public function deleteChat(int $userId)
	{
		Chat::where('room','like','%'.$userId.'%')->orWhere('room','like','%'.$userId);
	}
}