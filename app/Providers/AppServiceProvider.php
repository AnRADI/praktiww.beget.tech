<?php

namespace App\Providers;

use App\Contracts\Uploader;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Shop\WelcomeController;
use App\Services\Animal\Lion;
use App\Services\Uploader\ImageUploader;
use App\Services\Uploader\VideoUploader;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('path.public', function() {
			return base_path().'/public';
		});

//        $this->app->singleton(Lion::class, function ($app) {
//            return new Lion();
//        });

		//$this->app->tag([ImageDownloader::class, VideoUploader::class], 'reports');
		//$this->app->bind(Downloader::class, ImageDownloader::class);
//		$this->app->bind(Uploader::class, ImageUploader::class);
//        $this->app->when(WelcomeController::class)
//            ->needs(Uploader::class)
//            ->give(ImageUploader::class);
		//$this->app->bind(Downloader::class, ImageDownloader::class);
//		$this->app->bind(ImageUploader::class, function ($app) {
//			return new ImageUploader($app->make(VideoUploader::class), 66);
//		});


//		$this->app->when(WelcomeController::class)
//			->needs(Uploader::class)
//			->giveTagged('reports');

		//$this->app->bind(Uploader::class, ImageUploader::class);
//		$this->app->bind(Uploader::class, function ($app) {
//			return [$app->make(ImageUploader::class)];
//		});
//		$this->app->when(WelcomeController::class)
//					->needs(Uploader::class)
//					->give(function ($app) {
//						return [
//							new ImageUploader($app->make(ImageDownloader::class), $app->make(VideoDownloader::class))
//						];
//					});

//		$this->app->when(CategoriesController::class)
//			->needs(Uploader::class)
//			->give(VideoUploader::class);
//		$this->app->bind(Tol::class, function ($app){
//			return new Tol(new Bol(new Kol()));
//		});

//		$this->app->bind(QueryFilter::class, function ($app){
//			return new QueryFilter($app->make(Request::class));
//		});
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
