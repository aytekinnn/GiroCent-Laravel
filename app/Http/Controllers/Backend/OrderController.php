<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Campaigns;
use App\Models\Carts;
use App\Models\Installments;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Orders::with(['user'])->get();
        foreach ($order as $item){
            $productIds = $item->cartId;
            if (strpos($productIds,'||') !== false) {
                $productIds = explode('||',$productIds);
            } else {
                $productIds = [$productIds];
            }
            $product = Products::whereIn('id',$productIds)->get();
            $item->products = $product;
        }
        return view('backend.orders.index',compact('order'));
    }

    public function editView($id)
    {
        $order = Orders::where('id', $id)->with(['user'])->first();
        $created = date('Y-m-d', strtotime($order->created_at));
        $dogum = date('Y-m-d', strtotime($order->dogum));

        if ($order) {
            $productId = $order->cartId;
            $productIds = explode('||', $order->cartId);
            $adet = explode('||', $order->adet);
            $extraFeatureIds = explode('|||', $order->taksit);

            $extraFeaturePrice = 0;
            foreach($extraFeatureIds as $feature) {
                if ($feature) {
                    $featureParts = explode('||', $feature);
                    foreach ($featureParts as $part) {
                        $featureDetails = explode(',', $part);
                        if (isset($featureDetails[2]) && is_numeric($featureDetails[2])) {
                            $extraFeaturePrice += floatval($featureDetails[2]);
                        }
                    }
                }
            }

            $products = Products::whereIn('id', $productIds)->get();
            $campaigns = Campaigns::whereIn('product_id', $productIds)->get()->keyBy('product_id');

            // Calculate product details including extra features
            $order->products = $products;
            $order->campaigns = $campaigns;
            $order->extraFId = $extraFeatureIds;
            $order->adet = $adet;
        }

        return view('backend.orders.edit', compact('order','productId', 'extraFeaturePrice', 'created', 'dogum'));
    }


    public function edit(Request $request)
    {
        $order = Orders::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Sipariş Bulunamadı']);
        }
        switch ($request->action) {
            case 'onayla': // Onaylama işlemi
                $order->status = '2';
                $order->save();
                $cartIds = explode('||', $order->cartId);
                $prices = explode('||', $request->prices);
                $extraFeatureIds = explode('|||', $request->extra_feature_id);

                foreach ($cartIds as $index => $cartId) {
                    if (!isset($prices[$index])) {
                        continue;
                    }

                    $urunFiyati = floatval($prices[$index]);
                    $taksitSayisi = 1;

                    if (isset($extraFeatureIds[$index])) {
                        $featureParts = explode('||', $extraFeatureIds[$index]);
                        foreach ($featureParts as $part) {
                            $featureDetails = explode(',', $part);
                            if ($featureDetails[0] == 1) {
                                $taksitSayisi = (int) $featureDetails[1]; // Taksit sayısını güncelle
                                break; // İlk taksit bilgisini bulduktan sonra döngüyü durdur
                            }
                        }
                    }

                    $firstInstallmentDate = now()->addMonths();
                    $taksitTutari = $urunFiyati / $taksitSayisi; // Her bir taksit tutarını hesapla

                    for ($i = 1; $i <= $taksitSayisi; $i++) {
                        Installments::create([
                            'order_id'   => $order->id,
                            'user_id'    => $order->user_id,
                            'product_id' => $cartId, // cartId'yi product_id olarak kaydediyoruz
                            'taksit_no'  => $i,
                            'amount'     => $taksitTutari,
                            'due_date'   => $firstInstallmentDate->copy()->addMonths($i - 1),
                            'status'     => 0
                        ]);
                    }
                }


                return response()->json([
                    'success' => 'Taksitlendirme oluşturuldu. ',
                    'redirect_url' => route('order.index')
                ]);

            case 'reddet':
                $order->status = '3';
                $order->save();

                return response()->json([
                    'success' => 'Sipariş Reddedildi',
                    'redirect_url' => route('order.index')
                ]);

            case 'kismen-onayla':
                $order->status = '4';
                $order->save();
                return response()->json([
                    'success' => 'Kısmen Onaylandı',
                    'redirect_url' => route('order.index')
                ]);
            case 'limit-acildi':
                $order->status = '5';
                $order->save();
                return response()->json([
                    'success' => 'Limit Açıldı',
                    'redirect_url' => route('order.index')
                ]);

            case 'sozlesme-hazirla':
                $order->status = '6';
                $order->save();
                return response()->json([
                    'success' => 'Sözleşme Hazırlanıyor',
                    'redirect_url' => route('order.index')
                ]);

            case 'sozlesme-kargola':
                $order->status = '7';
                $order->save();
                return response()->json([
                    'success' => 'Sözleşme Kargolandı',
                    'redirect_url' => route('order.index')
                ]);

            case 'urun-hazirla':
                $order->status = '8';
                $order->save();
                return response()->json([
                    'success' => 'Ürün Hazırlanıyor',
                    'redirect_url' => route('order.index')
                ]);

            case 'urun-kargo':
                $order->status = '9';
                $order->save();
                return response()->json([
                    'success' => 'Ürün Kargolandı',
                    'redirect_url' => route('order.index')
                ]);

            case 'sozlesme-incele':
                $order->status = '10';
                $order->save();
                return response()->json([
                    'success' => 'Sözleşme İnceleniyor',
                    'redirect_url' => route('order.index')
                ]);

            default:
                return response()->json(['error' => 'Geçersiz işlem!']);
        }
    }

}
