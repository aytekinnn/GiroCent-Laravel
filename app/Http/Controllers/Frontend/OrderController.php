<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(REQUEST $request){

        $cartId = $request->cartId;

        $existingOrder = Orders::where('cartId', $cartId)
            ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->exists();

        if ($existingOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Bekleyen onayınız var!'
            ]);
        }
        $orderData = $request->all();
        /**
         *  $user_id
         *  $phone
         *  $tc
         *  $company_name
         *  $address
         *  $ulke
         *  $sehir
         *  $ilce
         *  $posta_kodu
         *  $icraDosya
         *  $calismaSuresi
         *  $aylikGelir
         *  $malVarligi
         *  $dogum
         *  $medeni_durum
         *  $evDurum
         *  $sgkDurum
         *  $baglanti
         *  $baglantiTelefon
         *  $message
         *  $status
         *  $taksit
         *  $cartId
        */
        $order = new Orders();
        $order->user_id = Auth::user()->id;
        $order->phone = $orderData['phone'];
        $order->tc = $orderData['tc'];
        $order->address = $orderData['address'];
        $order->company_name = $orderData['company_name'];
        $order->ulke = $orderData['ulke'];
        $order->sehir = $orderData['sehir'];
        $order->ilce = $orderData['ilce'];
        $order->posta_kodu = $orderData['posta_kodu'];
        $order->icraDosya = $orderData['icraDosya'];
        $order->calismaSuresi = $orderData['calismaSuresi'];
        $order->aylikGelir = $orderData['aylikGelir'];
        $order->malVarligi = $orderData['malVarligi'];
        $order->dogum = $orderData['dogum'];
        $order->medeni_durum = $orderData['medeni_durum'];
        $order->evDurum = $orderData['evDurum'];
        $order->sgkDurum = $orderData['sgkDurum'];
        $order->baglanti = $orderData['baglanti'];
        $order->baglantiTelefon = $orderData['baglantiTelefon'];
        $order->message = $orderData['message'];
        $order->status = 1;
        $order->taksit = $orderData['taksit'];
        $order->cartId = $orderData['cartId'];
        $order->adet = $orderData['adet'];
        $order->save();

        Carts::where('user_id', Auth::user()->id)->delete();

        return response()->json([
            'success' => true,
            'redirect_url' => route('checkout.complate'),
        ]);
    }

    public function index(){
        if (!Auth::check()) {
            return redirect()->route('login.front')->with('error', 'Siparişlerinizi görüntülemek için giriş yapmanız gerekmektedir.');
        }

        $orders = Orders::with(['user'])->where('user_id', Auth::user()->id)->get();

        foreach ($orders as $order) {
            $productIds = explode('||', $order->cartId);
            $order->products = Products::whereIn('id', $productIds)->get();
        }

        return view('frontend.default.order', compact('orders'));
    }


    public function complate(){
        return view('frontend.default.complate');
    }
}
