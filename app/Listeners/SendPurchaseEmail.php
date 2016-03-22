<?php
namespace App\Listeners;

use Mail;
use App\Events\PurchaseEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPurchaseEmail
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  PurchaseEmailEvent $event
	 *
	 * @return void
	 */
	public function handle(PurchaseEmailEvent $event)
	{
		$data = array('product' => $event->product,
		              'size'    => $event->size,
		              'colour'  => $event->colour);
		Mail::send('emails.purchase', array('data' => $data), function ($message) use ($event) {
			$message->to($event->user->getEmailForPasswordReset());
			$message->subject('SimpleStore Order: Thank you!');
		});
	}
}
