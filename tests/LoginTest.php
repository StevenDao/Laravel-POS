<?php
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Crypt;

class LoginTest extends TestCase
{
	use DatabaseTransactions;

	public function setUp()
	{
		// This method will automatically be called prior to any of your test cases
		parent::setUp();
		User::create(array('name'     => 'Admin',
		                   'email'    => 'admin@test.com',
		                   'password' => bcrypt('admin123'),
		                   'type'     => 'A'));
	}

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testValidLogin()
	{
		// Login Page
		$this->visit('/login')
		     ->see('SimpleStore')
		     ->see('Login')
		     ->see('E-Mail')
		     ->type('admin@test.com', 'email')
		     ->see('Password')
		     ->type('admin123', 'password')
		     ->press('Login')
		     ->seePageIs('/')
		     ->see('Product List');
	}

	public function testBlankLogin()
	{
		// Login Page
		$this->visit('/login')
		     ->see('SimpleStore')
		     ->see('Login')
		     ->see('E-Mail')
		     ->see('Password')
		     ->press('Login')
		     ->seePageIs('/login')
		     ->see('The email field is required.')
		     ->see('The password field is required.');
	}

	public function testForgotPassword()
	{
		// Login Page
		$this->visit('/login')
		     ->see('SimpleStore')
		     ->see('Login')
		     ->see('E-Mail')
		     ->see('Password')
		     ->click('Forgot Your Password?');
		// Reset Page
		$this->seePageIs('/password/reset')
		     ->see('Reset Password')
		     ->see('E-Mail Address')
		     ->type('admin@test.com', 'email')
		     ->press('Send Password Reset Link');
		// Page Reload with Success message
		$this->see('We have e-mailed your password reset link!');
		// Try again with blank email
		$this->press('Send Password Reset Link')
		     ->see('The email field is required.');
	}

	public function testRegistration()
	{
		// Login Page
		$this->visit('/login')
		     ->see('SimpleStore')
		     ->see('Login')
		     ->see('E-Mail')
		     ->see('Password')
		     ->click('Not A Member?');
		// Registration Page
		$password = $this->faker->password;
		$this->seePageIs('/register')
		     ->see('Name')
		     ->type($this->faker->name, 'name')
		     ->see('E-Mail Address')
		     ->type($this->faker->email, 'email')
		     ->see('Password')
		     ->type($password, 'password')
		     ->see('Confirm Password')
		     ->type($password, 'password_confirmation')
		     ->press('Register');
		// Logs in after Registration
		$this->seePageIs('/');
	}
}
