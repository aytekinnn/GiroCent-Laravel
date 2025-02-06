<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campaigns;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (Auth::check()) {
            $cartItem = Carts::where('user_id', Auth::id())->where('product_id', $request->id)->first();
            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                Carts::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->id,
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => 1,
                    'campaigns' => $request->campaigns,
                    'image' => $request->image,
                    'extra_features_id' =>$request->extra_features_id
                ]);
            }
            $cart = Carts::where('user_id', Auth::id())->get()->toArray();
        } else {
            $cart = session()->get('cart', []);
            $id = $request->id;

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += 1;
            } else {
                $cart[$id] = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'quantity' => 1,
                    'image' => $request->image
                ];
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'cartCount' => count($cart),
            'cartTotal' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'cartItems' => $cart
        ]);
    }

    public function remove(Request $request)
    {
        if (Auth::check()) {
            Carts::where('user_id', Auth::id())->where('product_id', $request->id)->delete();
            $cart = Carts::where('user_id', Auth::id())->get()->toArray();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        $cartTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return response()->json([
            'cartCount' => count($cart),
            'cartTotal' => $cartTotal,
            'cartItems' => $cart,
        ]);
    }


    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('register.front')->with('error', 'Sepeti görüntülemek için üye olmanız gerekmektedir.');
        }
        $kampanya = Campaigns::where('status', 1)
            ->with(['product'])
            ->orderBy('created_at', 'desc')
            ->first();
        $cart = Carts::where('user_id', Auth::id())
            ->with(['product', 'product.campaigns'])
            ->get();

        $features_id = $cart->pluck('extra_features_id');

        $totalPrice = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $totalDiscountPrice = $cart->sum(function ($item) {

            return ($item->product->campaigns->first()->new_price ?? $item->product->price) * $item->quantity;
        });



        $extraFeaturePrice = 0;

        if (!empty($features_id)) { // $features_id boş değilse işlem yap
            foreach ($features_id as $feature) {
                if (!empty($feature)) { // Eğer $feature boş değilse işlemi sürdür
                    $featureParts = explode('||', $feature);
                    foreach ($featureParts as $part) {
                        $featureDetails = explode(',', $part);

                        // Eğer fiyat bilgisi mevcutsa, sayıya çevirerek ekle
                        if (isset($featureDetails[2]) && is_numeric($featureDetails[2])) {
                            $extraFeaturePrice += floatval($featureDetails[2]);
                        }
                    }
                }
            }
        }

        $totalDiscount = $totalPrice - $totalDiscountPrice;
        $toplamFiyat = $totalPrice + $extraFeaturePrice - $totalDiscount;

        return view('frontend.default.cart', compact('cart', 'totalPrice', 'kampanya', 'totalDiscountPrice','toplamFiyat', 'totalDiscount', 'extraFeaturePrice'));

    }

    public function checkout(){
        if (!Auth::check()) {
            return redirect()->route('register.front')->with('error', 'Onaylama ekranı görüntülemek için üye olmanız gerekmektedir.');
        }
        $kampanya = Campaigns::where('status', 1)
            ->with(['product'])
            ->orderBy('created_at', 'desc')
            ->first();
        $cart = Carts::where('user_id', Auth::id())
            ->with(['product', 'product.campaigns']) // İndirim bilgilerini de al
            ->get();
        $adets = $cart->pluck('quantity');
        $adet = $adets->implode('||');

        $productIds = $cart->pluck('product_id');

        $cartId = $productIds->implode('||');

        $features_id = $cart->pluck('extra_features_id');
        $featuresIds = $cart->map(function ($item) {
            return $item->extra_features_id ?? 0;
        })->implode('|||');

        $totalPrice = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $totalDiscountPrice = $cart->sum(function ($item) {

            return ($item->product->campaigns->first()->new_price ?? $item->product->price) * $item->quantity;
        });



        $extraFeaturePrice = 0;

        if (!empty($features_id)) { // $features_id boş değilse işlem yap
            foreach ($features_id as $feature) {
                if (!empty($feature)) { // Eğer $feature boş değilse işlemi sürdür
                    $featureParts = explode('||', $feature);
                    foreach ($featureParts as $part) {
                        $featureDetails = explode(',', $part);

                        if (isset($featureDetails[0]) && $featureDetails[0] == 1 && isset($featureDetails[1]) && is_numeric($featureDetails[1])) {
                            $filteredFeaturePrices[] = floatval($featureDetails[1]);
                        }
                        // Eğer fiyat bilgisi mevcutsa, sayıya çevirerek ekle
                        if (isset($featureDetails[2]) && is_numeric($featureDetails[2])) {
                            $extraFeaturePrice += floatval($featureDetails[2]);
                        }
                    }
                }
            }
        }
        $totalDiscount = $totalPrice - $totalDiscountPrice;
        $toplamFiyat = $totalPrice + $extraFeaturePrice - $totalDiscount;

        return view('frontend.default.checkout', compact('cart', 'totalPrice','featuresIds', 'kampanya','toplamFiyat','extraFeaturePrice','cartId', 'adet', 'totalDiscountPrice', 'totalDiscount'));

    }
}
