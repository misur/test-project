<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
       $this->visit('/')
       		->see('Index');
    }

    public function testWelcome()
    {
    	 $this->visit('/')
             ->see('Index')
             ->dontSee('comments');
    }

   public function testWelcomeLogin()
   {
   		$this->visit('/')
   			 ->click('login')
   			 ->seePageIs('home/login');
   }

   public function testWelcomeCreate($value='')
   {
   		$this->visit('/')
   			 ->click('registration')
   			 ->seePageIs('users/create');
   }

   public function testWelcomeLogut($value='')
   {
    	$this->visit('/')
    		 ->click('logout')
    		 ->seePageIs('/');
   }

   public function testLoginLogin($value='')
   {
   		$this->visit('home/login')
   			 ->type('misur@gmail.com','email')
   			 ->press('prijavi se')
   			 ->seePageIs('home/login');
   }

   public function testLoginLogin2($value='')
   {
   		$this->visit('home/login')
   			 ->type('misur@gmail.com','email')
   			 ->press('prijavi se')
   			 ->see('The password field is required.');
   }

   public function testLoginLogin3($value='')
   {
   		$this->visit('home/login')
   			 ->type('misur@gmail.com','email')
   			 ->type('123456','password')
   			 ->press('prijavi se')
   			 ->seePageIs('/');
   }

    public function testLoginLogin4($value='')
   {
   		$this->visit('home/login')
   			 ->type('dasdsa','password')
   			 ->press('prijavi se')
   			 ->see('The email field is required.');
   }

}
