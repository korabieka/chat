<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Services\UserService;
use App\Http\Repositories\UserRepository;
use App\User;

class UserTest extends TestCase
{
	use DatabaseTransactions;
	private $userService;

	public function setUp(){
        parent::setUp();
        $this->userService = new UserService(new UserRepository);
        \DB::beginTransaction();
    }

	public function tearDown(){
        \DB::rollBack();
    }

    /**
     * function to test the saving of the user
     *
     * @return void
     */
    public function testSaveUser()
    {
		$user = $this->userService->saveUser('test');
		$this->assertEquals('test', $user->name);
		$this->assertEquals('',false);
    }

    public function testGetUsers()
    {
    	$users = $this->userService->getUsers();
		$this->assertNotNull($users);
    }
}
