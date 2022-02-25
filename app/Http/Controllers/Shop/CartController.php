<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
	public $product;

	public function __construct()
	{
		$this->product = new Product();
	}


	// ---------- /cart -----------

	public function index()
	{
		$cartCollection = Cart::get();

		return $cartCollection;
	}


	public function update($categorySlug, $productCode, Request $request)
	{
		$product = $this->product
			->firstProductCategoriesCTP($categorySlug, $productCode);


		if(empty($product)) abort(404);


		Cart::add($product, $request);


		return redirect()->route('cart');
	}


	public function removeProductCart($productCode, Request $request)
	{
		Cart::remove($productCode, $request);

		return redirect()->route('cart');
	}
}
