<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Campaigns;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create(REQUEST $request){

        $cartId = $request->cartId;
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen giriş yapın!'
            ]);
        }

        $existingOrder = Orders::where('cartId', $cartId)
            ->where('user_id', $user->id)
            ->where('status', 1)
            ->exists();

        if ($existingOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Bekleyen onayınız var!'
            ]);
        }

        $validate = Validator::make($request->all(), [
            'checkbox1' => 'required|accepted',
            'checkbox2' => 'required|accepted',
            'checkbox3' => 'required|accepted',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->first() // İlk hata mesajını döndür
            ]);
        }

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'tc' => 'required|string',
            'address' => 'required|string',
            'company_name' => 'required|string',
            'ulke' => 'required|string',
            'sehir' => 'required|string',
            'ilce' => 'required|string',
            'posta_kodu' => 'required|string',
            'icraDosya' => 'nullable|string',
            'calismaSuresi' => 'nullable|string',
            'aylikGelir' => 'nullable|string',
            'malVarligi' => 'nullable|string',
            'dogum' => 'required|date',
            'medeni_durum' => 'nullable|string',
            'evDurum' => 'nullable|string',
            'sgkDurum' => 'nullable|string',
            'baglanti' => 'nullable|string',
            'baglantiTelefon' => 'nullable|string',
            'message' => 'nullable|string',
            'taksit' => 'string',
            'sirket_gorev' => 'required|string',
            'maks_taksit_tutar' => 'required|string',
            'nufus_kayit_ilce' => 'required|string',
            'ikamet_suresi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first() // İlk hata mesajını döndür
            ]);
        }


        $order = Orders::create(array_merge($validator->validated(), [
            'user_id' => $user->id,
            'adet' => $request->adet,
            'cartId' => $cartId,
            'taksit' => $request->taksit,
            'status' => 1,
            'e_devlet_sifre' => Crypt::encryptString($request->e_devlet_sifre)
        ]));

        try {
            Mail::to('umutdeniz85@gmail.com')->send(new OrderShipped($order, $user));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sipariş oluşturuldu ancak e-posta gönderilirken bir hata oluştu.',
                'error' => $e->getMessage()
            ]);
        }

        Carts::where('user_id', $user->id)->delete();

        return response()->json([
            'success' => true,
            'redirect_url' => route('checkout.complate')
        ]);

    }

    public function index(){
        if (!Auth::check()) {
            return redirect()->route('login.front')->with('error', 'Siparişlerinizi görüntülemek için giriş yapmanız gerekmektedir.');
        }

        $orders = Orders::with(['user'])->where('user_id', Auth::user()->id)->get();

        foreach ($orders as $order) {
            $adet = explode('||', $order->adet);
            $productIds = explode('||', $order->cartId);
            $order->products = Products::whereIn('id', $productIds)->get();

            // Kampanyaları product_id'ye göre gruplayarak alıyoruz
            $campaigns = Campaigns::whereIn('product_id', $productIds)->get()->keyBy('product_id');

            // Taksit bilgilerini işliyoruz
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

            // Siparişe ilgili bilgileri ekliyoruz
            $order->adet = $adet;
            $order->extraFId = $extraFeatureIds;
            $order->campaigns = $campaigns;
            $order->extraFeaturePrice = $extraFeaturePrice;
        }


        return view('frontend.default.order', compact('orders'));
    }


    public function complate(){
        return view('frontend.default.complate');
    }
}
