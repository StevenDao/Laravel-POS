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
     * Show Products Details
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dbProduct = $this->productRepo->find($id);
        return view('product.edit')->with('dbProduct', $dbProduct);
    }

    /**
     * Show Products Details
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProductRequest $request)
    {
        $form = $request->all();
        $form['updated_at'] = Carbon::now();

        $dbProduct = $this->productRepo->update($form, $id);
        return redirect('/');
    }

    /**
     * Collect the form and store it in DB
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
        $form = $request->all();
        $form['created_at'] = Carbon::now();
        $form['updated_at'] = Carbon::now();

        $this->productRepo->create($form);

        return redirect('/');
    }

    /**
     * Delete entry
     *
     * @return ProductList Page
     */
    public function delete()
    {
        $id = Request::get('id');
        $this->productRepo->create($id);

        return view('/');
    }
}
