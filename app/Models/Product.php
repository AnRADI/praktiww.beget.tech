<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

	protected $guarded = [
		'_method',
		'_token',
	];


	// ========== RELATIONSHIPS ============

    public function categories()
	{
    	return $this->belongsToMany(Category::class);
	}




	// =========== METHODS =============


	public function getProductsCategoriesW() {

		$columnsProducts = [
			'id',
			'name',
			'price',
			'image',
			'code',
		];


//		$categories = Category::whereIn('name', ['Мобильные телефоны', 'Портативная техника'])->get();
//
//
//		$categories->each(function ($category) {
//			$category->load(['products' => function($query) {
//				$query->take(3);
//			}]);
//		});
//		dd($categories);


		$products = $this
			->select($columnsProducts)
			->with('categories:id,name,slug')
			->take(10)
			->get();

		$products->each(function ($product) {
			$product->setRelation('categories', $product->categories->take(1));
		});


		return $products;
	}


	public function firstProductCategoriesCP($categorySlug, $productCode) {

		$columnsProduct = [
			'id',
			'code',
			'name',
			'image',
			'price',
			'description'
		];

		$columnsCategories = [
			'id',
			'name',
			'slug',
		];

		$product = $this
			->select($columnsProduct)
			->where('code', $productCode)
			->with(['categories' => function($query) use($categorySlug, $columnsCategories) {
				$query
					->select($columnsCategories)
					->where('slug', $categorySlug);
			}])
			->first();


		return $product;
	}


	public function firstProductCategoriesCTP($categorySlug, $productCode) {

		$columnsProduct = [
			'id',
			'name',
			'price',
			'image',
			'code'
		];

		$columnsCategories = [
			'id',
			'name',
			'slug',
		];


		$product = $this
			->select($columnsProduct)
			->where('code', $productCode)
			->with(['categories' => function($query) use($categorySlug, $columnsCategories) {
				$query
					->select($columnsCategories)
					->where('slug', $categorySlug);
			}])
			->first();


		return $product;
	}


	public function getProductsDps() {

    	$products = $this
			->get();

    	return $products;
	}

	public function valueCodeDSA() {

    	$fieldCode = $this
			->orderBy('code', 'desc')
			->value('code');

    	return $fieldCode;
	}
}
