<?php
use App\Models\Products;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
	use DatabaseTransactions;

	public function setUp()
	{
		// This method will automatically be called prior to any of your test cases
		parent::setUp();
		// Create a new product in db for testing
		$this->createDbProduct();
	}

	/**
	 * Test Security
	 * Users should not be able to see the
	 * Add, Edit and Delete Icons
	 *
	 * @return void
	 */
	public function testProductList()
	{
		$this->be($this->user);
		$this->visit('/')
		     ->see('Product List');
		$this->dontSeeElement('span', array('class' => 'glyphicon glyphicon-plus'));
		$this->dontSeeElement('span', array('class' => 'glyphicon glyphicon-pencil'));
		$this->dontSeeElement('span', array('class' => 'glyphicon glyphicon-trash'));
		$response = $this->action('GET', 'HomeController@index');
		$this->assertNotEmpty($response->original->getData());
	}

	/**
	 * Test Security
	 * Admin should  be able to see the
	 * Add, Edit and Delete Icons
	 *
	 * @return void
	 */
	public function testAdminProductList()
	{
		$this->be($this->admin);
		$this->visit('/')
		     ->see('Product List');
		$this->seeElement('span', array('class' => 'glyphicon glyphicon-plus'));
		$this->seeElement('span', array('class' => 'glyphicon glyphicon-pencil'));
		$this->seeElement('span', array('class' => 'glyphicon glyphicon-trash'));
		$response = $this->action('GET', 'HomeController@index');
		$this->assertNotEmpty($response->original->getData());
	}

	/**
	 * Test Add New Product
	 * Through the application
	 *
	 * @return void
	 */
	public function testAdminAddProduct()
	{
		$this->be($this->admin);
		$this->visit('/product/create')
		     ->see('Add New Product')
		     ->see('Product Image:')
		     ->see('Product Name:')
		     ->see('Product Description:')
		     ->see('Product Price:');

		// Setup for new Product
		$img = $this->faker->image('/tmp', 640, 480);
		$name = $this->faker->name;
		$description = $this->faker->realText(4048, 2);
		$price = $this->faker->randomFloat(2, 0, 999.99);
		$this->attach($img, 'img')
		     ->type($name, 'name')
		     ->type($description, 'description')
		     ->type($price, 'price')
		     ->press('Add Product')
		     ->seePageIs('/');

		// Newest entry is the last item in DB
		$dbProduct = Products::all()->last();
		$this->assertNotNull($dbProduct);
		$this->assertEquals($dbProduct->img, $dbProduct->id . '.jpg');
		$this->assertEquals($dbProduct->name, $name);
		$this->assertEquals($dbProduct->description, $description);
		$this->assertEquals($dbProduct->price, $price);
	}

	/**
	 * Test Edit Product
	 * Through the application
	 *
	 * @return void
	 */
	public function testAdminEditProduct()
	{
		$this->be($this->admin);
		$this->visit('/product/create');

		// Setup for new Product
		$newProduct = $this->createDbProduct();

		$this->visit('/product/' . $newProduct->id . '/edit')
		     ->see('Edit Product')
		     ->see('Product Image:')
		     ->see('Product Name:')
		     ->see('Product Description:')
		     ->see('Product Price:');

		// Setup for Edit Product
		$img = $this->faker->image('/tmp', 640, 480);
		$name = $this->faker->name;
		$description = $this->faker->realText(4048, 2);
		$price = $this->faker->randomFloat(2, 0, 999.99);
		$this->attach($img, 'img')
		     ->type($name, 'name')
		     ->type($description, 'description')
		     ->type($price, 'price')
		     ->press('Update Product')
		     ->seePageIs('/');

		// Retrieve the edited product
		$dbProduct = Products::all()->where('id', $newProduct->id)->first();
		$this->assertNotNull($dbProduct);
		$this->assertEquals($dbProduct->img, $newProduct->id . '.jpg');
		$this->assertEquals($dbProduct->name, $name);
		$this->assertEquals($dbProduct->description, $description);
		$this->assertEquals($dbProduct->price, $price);
	}

	/**
	 * Test Delete Product
	 * Through the application
	 *
	 * @return void
	 */
	public function testAdminDeleteProduct()
	{
		$this->be($this->admin);
		$this->visit('/product/create');

		// Setup for new Product
		$newProduct = $this->createDbProduct();

		// Delete Item
		$this->delete($this->baseUrl . '/product/' . $newProduct->id);

		// Attempt to find Delete product
		$dbProduct = Products::all()->where('id', $newProduct->id);
		$this->assertEmpty($dbProduct);
	}
}
