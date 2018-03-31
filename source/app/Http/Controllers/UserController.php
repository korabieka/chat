<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\{UserService,ChatService};

/**
* This is our user controller class
*
* @author     Hussien Ashour
* @version    1
* ...
*/
class UserController extends Controller
{
	private $userService;
    
    public function __construct(UserService $userService , ChatService $chatService)
    {
    	$this->userService = $userService;
    	$this->chatService = $chatService;
    }

    /**
    * This function for saving the user  and starting the chat
    * @param UserRequest $request
    */
    public function mainChat(UserRequest $request)
    {
    	$user = $this->userService->saveUser($request->username);
    	return redirect()->route('chatbox',['userId'=>$user->id]);
    }

    /**
    * This function for stablishing the chat box
    * @param int $userId
    */
    public function chatBox(int $userId)
    {
        // check if the requested url belongs to the active user
        if (UserService::validateUser($userId)) {
            $users = $this->userService->getUsers();
            $user = $this->userService->getUser($userId);
            return view('chatbox',['user'=>$user,'users'=>$users]);
        }
        return abort(404);
    }

    /**
    * This function for log the user out
    */
    public function logout()
    {
    	$userId = session('user_id');
        // Delete the chat of the user from the database before logout
    	$this->chatService->deleteChat($userId);
        // Delete the user from the database
    	$this->userService->deleteUser($userId);
        // flushing the session of the user
    	session()->flush();
    	return redirect()->route('login');
    }
}
