<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\ExtraFeatures;
use App\Models\Faetures;
use App\Models\Manufacturers;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product = Products::with('manufacturer','feature')->get();
        foreach ($product as $item) {
            $categoryIds = $item->category_id;
            if (strpos($categoryIds, '||') !== false) {
                $categoryIds = explode('||', $categoryIds);
            } else {
                $categoryIds = [$categoryIds];
            }
            $categories = Categories::whereIn('id', $categoryIds)->get();
            $item->categories = $categories;
        }
        return view('backend.products.index',compact('product'));
    }




    public function store(){
        $category = Categories::where('status',1)
            ->get();
        $manufacturer = Manufacturers::where('status',1)->get();
        $feature = Faetures::where('status',1)->get();
        $extraFeature = ExtraFeatures::where('status',1)->get();
        return view('backend.products.store',compact('category','manufacturer','feature','extraFeature'));
    }

    public function getFeature(){
        $feature = Faetures::where('status',1)->get();
        return response()->json($feature);
    }

    public function getExtraFeature(){
        $feature = ExtraFeatures::where('status',1)->get();
        return response()->json($feature);
    }

    public function edit(Request $request){
        $id = $request->input('id');

        $product = Products::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'slug' => 'required|string|max:150',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5096'
            ]);

            if ($product->image) {
                $oldImagePath = public_path('images/products/' . $product->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file_name = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/products'), $file_name);
            $product->image = $file_name; // Yeni resmi at
        } else {
            $product->image = $request->input('old_file', $product->image);
        }

        $category_id = $request->input('category_id');
        $feature_ids = $request->input('feature_id');
        $extraFeature_ids = $request->input('extra_feature_id');
        $descriptions = $request->input('feature_description');
        $extra_feature_description = $request->input('extra_feature_description');
        $extra_feature_price = $request->input('extra_feature_price');
        $features = [];
        foreach ($feature_ids as $index => $feature_id) {
            $features[] = $feature_id . ',' . $descriptions[$index];
        }
        $extraFeatures = [];
        foreach ($extraFeature_ids as $index => $extraFeature_id) {
            $extraFeatures[] = $extraFeature_id . ',' . $extra_feature_description[$index] . ',' . $extra_feature_price[$index];
        }
        $extraFeaturesString = implode('||', $extraFeatures);
        $featuresString = implode('||', $features);
        $categoryString = implode('||', $category_id);

        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->slug = $validatedData['slug'];
        $product->price = $request->input('price');
        $product->product_code = $request->input('product_code');
        $product->location = $request->input('location');
        $product->tax_class = $request->input('tax_class');
        $product->stock = $request->input('stock');
        $product->gecerlilik_tarih = $request->input('gecerlilik_tarih');
        $product->stok_dis_durum = $request->input('stok_dis_durum');
        $product->kargo = $request->input('kargo');
        $product->stok_dus = $request->input('stok_dus');
        $product->durum = $request->input('durum');
        $product->uretici_id = $request->input('uretici_id');
        $product->one_cikar = $request->input('one_cikar');
        $product->category_id = $categoryString;
        $product->features_id = $featuresString;
        $product->extra_features_id = $extraFeaturesString;

        $product->save();
        return response()->json([
            'success' => true,
            'message' => 'Ürün başarıyla Güncellendi.'
        ]);
    }

    public function create(REQUEST $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'slug' => 'required|string|max:150',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $price = $request->input('price');
        $tax_class = $request->input('tax_class');
        $price += $price * ($tax_class == 0 ? 0.10 : 0.20);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5096'
            ]);
            $file_name = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/products'), $file_name);
        } else {
            $file_name = null;
        }

        $category_id = $request->input('category_id');
        $feature_ids = $request->input('feature_id');
        $descriptions = $request->input('feature_description');

        $extraFeature_ids = $request->input('extra_feature_id');
        $descript = $request->input('extra_feature_description');
        $prices = $request->input('extra_feature_price');

        $features = [];
        foreach ($feature_ids as $index => $feature_id) {
            $features[] = $feature_id . ',' . $descriptions[$index];
        }

        $extraFeatures = [];
        foreach ($extraFeature_ids as $index => $extraFeature_id) {
            $extraFeatures[] = $extraFeature_id . ',' . $descript[$index] . ',' . $prices[$index];
        }

        $extraFeaturesString = implode('||', $extraFeatures);
        $featuresString = implode('||', $features);
        $categoryString = implode('||', $category_id);

        /** @var Products $product */
        $product = new Products();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->slug = $validatedData['slug'];
        $product->image = $file_name;
        $product->price = $price;
        $product->product_code = $request->product_code;
        $product->location = $request->location;
        $product->tax_class = $request->tax_class;
        $product->stock = $request->stock;
        $product->gecerlilik_tarih = $request->gecerlilik_tarih;
        $product->stok_dis_durum = $request->stok_dis_durum;
        $product->one_cikar = $request->one_cikar;
        $product->kargo = $request->kargo;
        $product->stok_dus = $request->stok_dus;
        $product->durum = $request->durum;
        $product->uretici_id = $request->uretici_id;
        $product->category_id = $categoryString;
        $product->features_id = $featuresString;
        $product->extra_features_id = $extraFeaturesString;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Ürün başarıyla yayınlandı.'
        ]);

    }

    public function editView($id)
    {
        $product = Products::where('id', $id)->with('feature', 'manufacturer')->first();
        $category = Categories::where('status', 1)->get();
        $manufacturer = Manufacturers::where('status', 1)->get();
        $feature = Faetures::where('status', 1)->get();
        $extraFeature = ExtraFeatures::where('status',1)->get();

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
            $parsedFeatures = [];

            if ($featuresData) {
                $featuresArray = explode('||', $featuresData);

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
            }

            $extraFeaturesData = $product->extra_features_id;
            $parsedExtraFeatures = [];

            if ($extraFeaturesData) {
                $extraFeaturesArray = explode('||', $extraFeaturesData);
                foreach ($extraFeaturesArray as $extraFeatureItem) {
                    list($extraFeatureId, $content, $price) = explode(',', $extraFeatureItem);
                    $extraFeatureDetails = ExtraFeatures::find($extraFeatureId);

                    if ($extraFeatureDetails) {
                        $parsedExtraFeatures[] = [
                            'feature' => $extraFeatureDetails,
                            'content' => $content,
                            'price' => $price,
                        ];
                    }
                }
            }
            $product->parsedExtraFeatures = $parsedExtraFeatures;
            $product->parsedFeatures = $parsedFeatures;
        }

        return view('backend.products.edit', compact('product', 'extraFeature', 'category', 'manufacturer', 'feature'));
    }



    public function destroy($id)
    {
        $product = Products::find($id);

        if ($product) {
            $imagePath = public_path('images/products/' . $product->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            if ($product->delete()) {
                return back()->with('success', 'Ürün ve resmi başarıyla silindi');
            } else {
                return back()->with('error', 'Ürün silinirken bir hata oluştu');
            }
        } else {
            return back()->with('error', 'Ürün bulunamadı');
        }
    }

}
