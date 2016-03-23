<?php

use App\Events\PurchaseEmailEvent;
use App\Models\Products;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;

class PurchaseTest extends TestCase
{
	use  DatabaseTransactions;

	public function setUp()
	{
		// This method will automatically be called prior to any of your test cases
		parent::setUp();
		// Create a new product in db for testing
		$this->createDbProduct();
	}

	/**
	 * Test Application for purchasing the first item
	 *
	 * @return void
	 */
	public function testPurchaseWithButton()
	{
		$this->expectsEvents(PurchaseEmailEvent::class);
		$this->be($this->user);
		// Press Purchase one the First Item
		$this->visit('/')
		     ->press('Purchase')
		     ->see('Thank you from')
		     ->see('Your Purchase');
	}

	/**
	 * Test purchase POST
	 *
	 * @return void
	 */
	public function testPurchasePost()
	{
		$this->expectsEvents(PurchaseEmailEvent::class);
		$this->be($this->user);
		$dbProduct = Products::all()->last();
		$this->post($this->baseUrl . '/purchase/' . $dbProduct->id,
		            ['id'       => $dbProduct->id,
		             'sizeId'   => $this->faker->numberBetween(1, 5),
		             'colourId' => $this->faker->numberBetween(1, 7)])
		     ->seePageIs('/purchase/' . $dbProduct->id)
		     ->see('Thank you from')
		     ->see('Your Purchase')
		     ->see($dbProduct->name)
		     ->see($dbProduct->description)
		     ->see($dbProduct->price);
	}
}
