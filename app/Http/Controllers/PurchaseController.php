<?php
namespace App\Http\Controllers;

use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs\SendPurchaseEmail;
use App\Repositories\ColourRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SizeRepository;

class PurchaseController extends Controller
{
	protected $user;
	protected $colourRepo;
	protected $productRepo;
	protected $sizeRepo;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(ColourRepository $colourRepo,
	                            ProductRepository $productRepo,
	                            SizeRepository $sizeRepo)
	{
		$this->middleware('auth');
		$this->user = Auth::user();
		$this->colourRepo = $colourRepo;
		$this->productRepo = $productRepo;
		$this->sizeRepo = $sizeRepo;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function purchase($id, Request $request)
	{
		$purchased = $this->productRepo->find($id);
		$size = $this->sizeRepo->find($request->get('sizeId'));;
		$colour = $this->colourRepo->find($request->get('colourId'));
		// Push email to the queue :)
		$this->dispatch(new SendPurchaseEmail($this->user, $purchased, $size, $colour));
		$data = array('product' => $purchased,
		              'size'    => $size,
		              'colour'  => $colour);

		return view('emails.purchase')->with('data', $data);
	}
}