<?php
namespace App\Jobs;

use App\Jobs\Job;
use App\Models\Products;
use App\Models\User;
use Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPurchaseEmail extends Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	protected $user;
	protected $product;
	protected $size;
	protected $colour;

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

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$data = array('product' => $this->product,
		              'size'    => $this->size,
		              'colour'  => $this->colour);
		Mail::send('emails.purchase', array('data' => $data), function ($message) {
			$message->to($this->user->getEmailForPasswordReset());
			$message->subject('SimpleStore Order: Thank you!');
		});
	}
}
