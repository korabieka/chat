<?php

namespace App\Http\Repositories;

use App\User;

class UserRepository
{

	public function saveUser($username)
	{
		$user = new User;
		$user->name = $username;
		$user->save();
		return $user;
	}

	public function getUsers()
	{
		$users = User::all();
		return $users;
	}

	public function getUser($id)
	{
		return User::find($id);
	}

	public function deleteUser($id)
	{
		User::find($id)->delete();
	}
}