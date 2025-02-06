<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Informations;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        // Sadece layout.blade.php ve iç içe kullanılan sayfalara veri gönderir
        View::composer('frontend.layout', function ($view) {
            $product = Products::where('durum', 1)->with('category','manufacturer','feature')->get();
            $categories = Categories::where('status', 1)->whereNull('ust_id')->with('subCategories')->get();
            $information = Informations::where('status', 1)->get();
            $cate = Categories::where('status', 1)->get();
            $cat = Categories::where('popular_category', 1)->get();

            $view->with([
                'product' => $product,
                'categories' => $categories,
                'information' => $information,
                'cate' => $cate,
                'cat' => $cat,
            ]);
        });
    }
}
