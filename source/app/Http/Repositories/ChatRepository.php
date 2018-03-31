<?php

namespace App\Http\Repositories;

use App\Chat;

class ChatRepository
{

	public function saveMessage($data)
	{
			$chat = new Chat;
			$chat->message = $data->message;
			$chat->room = 'room_'.$data->sender.'_'.$data->reciever;
			$chat->user_id = $data->sender;
			$chat->save();
			return true;
	}

	public static function getChat($senderId , $recieverId)
	{
		return Chat::where('room','room_'.$senderId.'_'.$recieverId)->orWhere('room','room_'.$recieverId.'_'.$senderId)->get();
	}

	public static function getLastCreatedAt($senderId , $recieverId)
	{
		$row = Chat::where('room','room_'.$senderId.'_'.$recieverId)->orWhere('room','room_'.$recieverId.'_'.$senderId)->orderBy('created_at','desc')->first();
		if(!$row) {
			return 0;
		}
		return $row->created_at;	
	}

	public function deleteChat($userId)
	{
		Chat::where('room','like','%'.$userId.'%')->orWhere('room','like','%'.$userId);
	}
}