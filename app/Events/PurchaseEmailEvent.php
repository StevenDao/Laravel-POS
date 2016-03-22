<?php
namespace App\Events;

use App\Jobs\Job;
use App\Models\Products;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class PurchaseEmailEvent extends Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	public $user;
	public $product;
	public $size;
	public $colour;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Products $products, $size, $colour)
	{
		$this->user = $user;
		$this->product = $products;
		$this->size = $size;
		$this->colour = $colour;
	}
}
