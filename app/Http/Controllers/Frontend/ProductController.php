<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campaigns;
use App\Models\Categories;
use App\Models\ExtraFeatures;
use App\Models\Faetures;
use App\Models\Gallery;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        $category = Categories::where('slug', $slug)->first();
        if ($slug == 'kampanya') {
            $query = Products::where('durum', 1)
                ->with(['campaigns'])
                ->whereHas('campaigns');
        } else {

            if (!$category) {
                abort(404);
            }
            $query = Products::where('durum', 1)
                ->with(['campaigns'])
                ->whereRaw("FIND_IN_SET(?, REPLACE(category_id, '||', ','))", [$category->id]);
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    break;
            }
        }

        $perPage = 16;
        $products = $query->paginate($perPage);

        return view('frontend.product.filter', compact('products', 'category'));
    }


    public function search(Request $request)
    {
        $query = $request->get('query');

        $products = Products::query()
            ->where('name', 'like', '%' . $query . '%')
            ->with(['campaigns'])
            ->get(['id', 'name', 'price', 'image', 'price','slug']);

        foreach ($products as $product) {
            if ($product->campaigns->first()) {
                $product->new_price = $product->campaigns->first()->new_price;
                $product->old_price = $product->price;
            } else {
                $product->new_price = $product->price;
                $product->old_price = null;
            }
        }

        return response()->json(['products' => $products]);
    }


    public function detail($slug){
        $product = Products::where('slug', $slug)->with('feature', 'manufacturer')->first();
        $product_id = $product->id;
        $galeri = Gallery::where('product_id', $product_id)->get();
        if ($product) {

            $categoryIds = $product->category_id;
            if (strpos($categoryIds, '||') !== false) {
                $categoryIds = explode('||', $categoryIds);
            } else {
                $categoryIds = [$categoryIds];
            }
            $categories = Categories::whereIn('id', $categoryIds)->get();
            $product->categories = $categories;

            $featuresData = $product->features_id;

            if ($featuresData) {
                $featuresArray = explode('||', $featuresData);

                $parsedFeatures = [];
                foreach ($featuresArray as $featureItem) {
                    list($featureId, $content) = explode(',', $featureItem);

                    $featureDetails = Faetures::find($featureId);

                    if ($featureDetails) {
                        $parsedFeatures[] = [
                            'feature' => $featureDetails,
                            'content' => $content,
                        ];
                    }
                }

                // Özellikleri ID'ye göre grupla
                $groupedFeatures = collect($parsedFeatures)->groupBy('feature.id');

                $product->groupedFeatures = $groupedFeatures;
            }

            $extraFeaturesData = $product->extra_features_id;
            if ($extraFeaturesData) {
                $extraFeaturesArray = explode('||', $extraFeaturesData);
                $parsedExtraFeatures = [];
                foreach ($extraFeaturesArray as $extraFeatureItem) {
                    list($extraFeatureId, $content, $price) = explode(',', $extraFeatureItem);
                    $extraFeatureDetails = ExtraFeatures::find($extraFeatureId);
                    if ($extraFeatureDetails) {
                        $parsedExtraFeatures[] = [
                            'id' => $extraFeatureId,
                            'feature' => $extraFeatureDetails,
                            'content' => $content,
                            'price' => $price,
                        ];
                    }
                }
                $groupedExtraFeatures = collect($parsedExtraFeatures)->groupBy('feature.id');
                $product->groupedExtraFeatures = $groupedExtraFeatures;
            }

            $similarProducts = Products::where('id', '!=', $product->id) // Farklı ürünler
            ->get(); // Önce tüm ürünleri alıyoruz

            $similarProducts = $similarProducts->filter(function($similarProduct) use ($categoryIds) {
                $productCategories = explode('||', $similarProduct->category_id); // Benzer ürünün kategorilerini al
                // Kesişen kategori var mı diye kontrol et
                return !empty(array_intersect($categoryIds, $productCategories));
            });

            // Benzer ürünleri belirli bir sayıda limitliyoruz
            $similarProducts = $similarProducts->take(6);
            $kampanya = Campaigns::where('status', 1)
                ->with(['product'])
                ->orderBy('created_at', 'desc')
                ->first();
            return view('frontend.product.detail', compact('product', 'galeri', 'similarProducts','kampanya'));
        }
    }
}
