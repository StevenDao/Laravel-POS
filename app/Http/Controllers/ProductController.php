<?php
namespace App\Http\Controllers;

use App\Models\Products;
use App\Repositories\ProductRepository;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	protected $productRepo;

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
	 * Display New Products Page
	 *
	 * @return ProductList Page
	 */
	public function create()
	{
		return view('product.new');
	}

	/**
	 * Collect the form and store it in DB
	 *
	 * @return ProductList Page
	 */
	public function store(ProductRequest $request)
	{
		// Create DB Record first
		$form = $request->all();
		$form['created_at'] = Carbon::now();
		$form['updated_at'] = Carbon::now();
		// New Record is returned
		$newProduct = $this->productRepo->create($form);
		// If a file was uploaded
		if ($request->hasFile('img')) {
			$extension = $request->file('img')->getClientOriginalExtension(); // getting image extension
			$filename = $newProduct->id . '.' . $extension;
			$file = $request->file('img');
			$file->move(public_path() . '/img/', $filename);
			// Update record with new image name
			$form['img'] = $filename;
			$newProduct->update($form);
		}

		return redirect('/');
	}

	/**
	 * Display Edit Products Page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$dbProduct = $this->productRepo->find($id);

		return view('product.edit')->with('dbProduct', $dbProduct);
	}

	/**
	 * Update Products to DB
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update($id, ProductRequest $request)
	{
		$form = $request->all();

		if ($request->hasFile('img')) {
			$extension = $request->file('img')->getClientOriginalExtension(); // getting image extension
			$filename = $id . '.' . $extension;
			$file = $request->file('img');
			$file->move(public_path() . '/img/', $filename);
			$form['img'] = $filename;
		}

		$form['updated_at'] = Carbon::now();
		$dbProduct = $this->productRepo->update($form, $id);

		return redirect('/');
	}

	/**
	 * Delete entry
	 *
	 * @return ProductList Page
	 */
	public function destroy($id)
	{
		$this->productRepo->delete($id);

		return redirect('/');
	}
}
