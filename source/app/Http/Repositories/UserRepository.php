<?php

namespace App\Http\Repositories;

use App\User;

/**
* This is our user repository class
*
* @author     Hussien Ashour
* @version    1
* ...
*/
class UserRepository
{

    /**
    * This function for saving the user in the database
    * @param mixed $username
    * @return User $user
    */
	public function saveUser(string $username)
	{
		$user = new User;
		$user->name = $username;
		$user->save();
		return $user;
	}

    /**
    * This function for retrieving all users from the database
    * @return array $users
    */
	public function getUsers()
	{
		$users = User::all();
		return $users;
	}

    /**
    * This function for retrieving user from the database by his id
    * @param int $id
    * @return User $user
    */
	public function getUser(int $id)
	{
		return User::find($id);
	}

    /**
    * This function for deleting user from the database by his id
    * @param int $id
    */
	public function deleteUser(int $id)
	{
		User::find($id)->delete();
	}
}