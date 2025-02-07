<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Carts;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'tc' => 'required|string',
            'address' => 'required|string',
            'company_name' => 'nullable|string',
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first() // İlk hata mesajını döndür
            ]);
        }

// Sipariş oluştur
        $order = Orders::create(array_merge($validator->validated(), [
            'user_id' => $user->id,
            'adet' => $request->adet,
            'cartId' => $cartId,
            'taksit' => $request->taksit,
            'status' => 1,
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
            $productIds = explode('||', $order->cartId);
            $order->products = Products::whereIn('id', $productIds)->get();
        }

        return view('frontend.default.order', compact('orders'));
    }


    public function complate(){
        return view('frontend.default.complate');
    }
}
