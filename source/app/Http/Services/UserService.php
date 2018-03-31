<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

/**
* This is our user service class
*
* @author     Hussien Ashour
* @version    1
* ...
*/
class UserService
{
	private $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

    /**
    * This function for saving the user
    * @param mixed $username
    * @return User $user
    */
	public function saveUser(string $username)
	{
		$user = $this->userRepository->saveUser($username);
		if($user) {
			// set the session of the s=user
			session(['user_id'=>$user->id]);
			return $user;
		} else {
			return false;
		}
	}

    /**
    * This function for retrieving all users
    * @return array $users
    */
	public function getUsers()
	{
		$users = $this->userRepository->getUsers();
		return $users;
	}

	/**
    * This function for retrieving user by his id
    * @param int $id
    * @return User $user
    */
	public function getUser(int $id)
	{
		$user = $this->userRepository->getUser($id);
		return $user;
	}

    /**
    * check if the id requested is the same as the active user's id or not
    * @param int $id
    * @return boolean
    */
	public static function validateUser(int $id)
	{
		if ($id != session('user_id')) {
			return false;
		} else {
			return true;
		}
	}
    
    /**
    * This function for deleting user by his id
    * @param int $id
    */
	public function deleteUser(int $userId)
	{
		$this->userRepository->deleteUser($userId);
	}

}
	