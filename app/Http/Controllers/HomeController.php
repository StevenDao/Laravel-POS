<?php
namespace App\Http\Controllers;

use App\Models\Colour;
use App\Models\Size;
use App\Repositories\ProductRepository;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	protected $colourRepo;
	protected $productRepo;
	protected $sizeRepo;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(ProductRepository $productRepo)
	{
		$this->middleware('auth');
		$this->productRepo = $productRepo;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$allColours = Colour::pluck('name', 'id');
		$allProducts = $this->productRepo->all();
		$allSizes = Size::pluck('name', 'id');

		return view('home')->with('allColours', $allColours)
		                   ->with('allProducts', $allProducts)
		                   ->with('allSizes', $allSizes);
	}
}
