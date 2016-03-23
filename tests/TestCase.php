<?php
use App\Models\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
	/**
	 * The base URL to use while testing the application.
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://localhost';
	protected $faker;
	protected $user;
	protected $admin;

	public function setUp()
	{
		parent::setUp();
		$this->faker = Faker\Factory::create();
		$this->user = new User(array('name' => 'Test'));
		$this->admin = new User(array('name' => 'Admin', 'type' => 'A'));
	}

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__ . '/../bootstrap/app.php';
		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}
}
