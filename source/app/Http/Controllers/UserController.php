<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Http\Services\ChatService;

class UserController extends Controller
{
	private $userService;
    
    public function __construct(UserService $userService , ChatService $chatService)
    {
    	$this->userService = $userService;
    	$this->chatService = $chatService;
    }

    public function mainChat(UserRequest $request)
    {
    	$user = $this->userService->saveUser($request->username);
    	return redirect()->route('chatbox',['userId'=>$user->id]);
    }

    public function chatBox($userId)
    {
        if (UserService::validateUser($userId)) {
            $users = $this->userService->getUsers();
            $user = $this->userService->getUser($userId);
            return view('chatbox',['user'=>$user,'users'=>$users]);
        }
        return abort(404);
    }

    public function logout()
    {
    	$userId = session('user_id');
    	$this->chatService->deleteChat($userId);
    	$this->userService->deleteUser($userId);
    	session()->flush();
    	return redirect()->route('login');
    }
}
