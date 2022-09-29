<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	//Category::factory(4)->create();
		//Cat::factory(100)->create();
		$this->call([
			CategorySeeder::class,
			ProductSeeder::class,
			LabelSeeder::class,
			LabelProductSeeder::class,
			CategoryProductSeeder::class,
			PermissionSeeder::class,
		]);
    }
}
