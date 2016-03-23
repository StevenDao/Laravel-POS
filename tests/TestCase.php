<?php
use App\Models\User;
use App\Models\Products;

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
		$this->user = new User(array('name' => 'Test', 'email' => 'test@test.com'));
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

	/**
	 * Creates new product in db.
	 *
	 * @return NewProductModel
	 */
	public function createDbProduct()
	{
		$img = $this->faker->image($dir = '/tmp', $width = 640, $height = 480);
		$name = $this->faker->name;
		$description = $this->faker->realText($maxNbChars = 4048, $indexSize = 2);
		$price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 999.99);

		return Products::create(['img'         => $img,
		                         'name'        => $name,
		                         'description' => $description,
		                         'price'       => $price,]);
	}
}
