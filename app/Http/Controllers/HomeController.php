<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository as Products;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $products;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Products $products)
    {
        $this->middleware('auth');
        $this->products = $products;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProducts = $this->products->all();

        return view('home')->with('allProducts', $allProducts);
    }
}
