<?php

namespace App\Http\Controllers\Shop;

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{

	public $category;

	public function __construct()
	{
		$this->category = new Category();
	}


	// ---------- /{category_slug} -----------

	public function index($categorySlug) {

		$category = $this->category
			->firstCategoryProductsC($categorySlug);

		if(empty($category)) abort(404);

		//$category->products->loadMissing('categories:id,slug');


		return Inertia::render('Shop/Category', [
			'category' => $category,
		]);
	}
}
