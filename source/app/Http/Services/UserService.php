<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class UserService
{
	private $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function saveUser($username)
	{
		$user = $this->userRepository->saveUser($username);
		if($user) {
			session(['user_id'=>$user->id]);
			return $user;
		} else {
			return false;
		}
	}
		public function getUsers()
		{
			$users = $this->userRepository->getUsers();
			return $users;
		}

		public function getUser($id)
		{
			$user = $this->userRepository->getUser($id);
			return $user;
		}

		public static function validateUser($id)
		{
			if ($id != session('user_id')) {
				return false;
			} else {
				return true;
			}
		}

		public function deleteUser($userId)
		{
			$this->userRepository->deleteUser($userId);
		}

	}
	