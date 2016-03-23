<?php
use App\Models\Products;
use App\Repositories\ProductRepository;
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
	}

	/**
	 * A basic test example.
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
		$response->original->getData();
	}

	public function testAdminProductList()
	{
		$this->be($this->admin);
		$this->visit('/')
		     ->see('Product List');
		$this->seeElement('span', array('class' => 'glyphicon glyphicon-plus'));
	}

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

	/*
	 * This is repetitive... How can I fix this?
	 */
	public function testAdminEditProduct()
	{
		$this->be($this->admin);
		$this->visit('/product/create');

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

		$dbProduct = Products::all()->last();
		$this->visit('/product/' . $dbProduct->id . '/edit')
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

		// Newest entry is the last item in DB
		$dbProduct = Products::all()->last();
		$this->assertNotNull($dbProduct);
		$this->assertEquals($dbProduct->img, $dbProduct->id . '.jpg');
		$this->assertEquals($dbProduct->name, $name);
		$this->assertEquals($dbProduct->description, $description);
		$this->assertEquals($dbProduct->price, $price);
	}

	public function testAdminDeleteProduct()
	{
		$this->be($this->admin);
		$this->visit('/product/create');

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

		// save product before deletion
		$oldProduct = $dbProduct;
		$this->delete($this->baseUrl . '/product/' . $dbProduct->id);

		// Get last Entry from db
		$dbProduct = Products::all()->last();
		// If deleted ids should not be equal
		$this->assertTrue((is_null($dbProduct) || $dbProduct->id != $oldProduct->id),
			'Product was not Delete Properly!');
	}
}
