<?php

use App\Models\Products;
use App\Events\PurchaseEmailEvent;
use App\Listeners\SendPurchaseEmail;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
Use Illuminate\Support\Facades\Mail;

class MailerTest extends TestCase
{
	/**
	 * Test Mail Even Listener
	 *
	 * @return void
	 */
	public function testPurchaseEmailListener()
	{
		// Mock Product for Event
		$mockProducts = Mockery::mock('App\Model\Products')
		                       ->shouldReceive('create')
		                       ->once()
		                       ->andReturn(new Products(array('name'        => 'productName',
		                                                      'description' => 'productDesc',
		                                                      'price'       => 92.32)));
		$this->app->instance('Products', $mockProducts);
		$products = $mockProducts->getMock()->create();
		$size = $this->faker->numberBetween(1, 5);
		$colour = $this->faker->numberBetween(1, 7);

		// Create new Event
		$event = new PurchaseEmailEvent($this->user, $products, $size, $colour);

		// Create new Listener
		$listen = new SendPurchaseEmail();

		// Call the handler
		$listen->handle($event);
	}

	/**
	 * Test Mail Even Listener
	 *
	 * @return void
	 */
	public function testPurchaseMailer()
	{
		// Mock Product for Event
		$mockProducts = Mockery::mock('App\Model\Products')
		                       ->shouldReceive('create')
		                       ->once()
		                       ->andReturn(new Products(array('name'        => 'productName',
		                                                      'description' => 'productDesc',
		                                                      'price'       => 92.32)));
		$this->app->instance('Products', $mockProducts);
		$products = $mockProducts->getMock()->create();
		$size = $this->faker->numberBetween(1, 5);
		$colour = $this->faker->numberBetween(1, 7);

		// Create new Event
		$event = new PurchaseEmailEvent($this->user, $products, $size, $colour);

		// Mock Mail
		Mail::shouldReceive('send')->once()->with(
			'emails.purchase',
			Mockery::on(function ($data) {
				$this->assertArrayHasKey('data', $data);
				$this->assertArrayHasKey('product', array_get($data, 'data'));

				return true;
			}),
			Mockery::on(function (\Closure $closure) use ($event) {
				$mock = Mockery::mock('Illuminate\Mailer\Message');
				$mock->shouldReceive('to')
				     ->once()
				     ->with($this->user->email)
				     ->andReturn($mock); //simulate the chaining
				$mock->shouldReceive('subject')
				     ->once()
				     ->with('SimpleStore Order: Thank you!');
				$closure($mock);

				return true;
			})
		);

		// Create new Listener
		$listen = new SendPurchaseEmail();

		// Call the handler
		$listen->handle($event);
	}
}
