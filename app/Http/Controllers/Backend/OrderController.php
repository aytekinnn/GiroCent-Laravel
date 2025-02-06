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
            $productIds = $order->cartId;
            if (strpos($productIds, '||') !== false) {
                $productIds = explode('||', $productIds);
            } else {
                $productIds = [$productIds];
            }

            $adet = $order->adet;
            if (strpos($adet, '||') !== false) {
                $adet = explode('||', $adet);
            } else {
                $adet = [$adet];
            }

            $products = Products::whereIn('id', $productIds)->get();

            $campaigns = Campaigns::whereIn('product_id', $productIds)
                ->get()
                ->keyBy('product_id');

            $order->products = $products;
            $order->campaigns = $campaigns;
            $order->adet = $adet;
        }

        return view('backend.orders.edit', compact('order', 'created', 'dogum'));
    }

    public function edit(Request $request)
    {
        $order = Orders::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Sipariş Bulunamadı']);
        }

        switch ($request->action) {
            case 'approve': // Onaylama işlemi
                $order->status = '2';
                $order->save();

                $cartIds = explode('||', $order->cartId);
                $adetler = explode('||', $order->adet);

                if (count($cartIds) !== count($adetler)) {
                    return response()->json(['error' => 'Sepet verileri hatalı!']);
                }

                foreach ($cartIds as $index => $cartId) {
                    $adet = (int) $adetler[$index];

                    $product = Products::where('id', $cartId)->first();

                    if ($product && $product->stok_dus == 1) {
                        $product->stock -= $adet;
                        $product->stock = max(0, $product->stock); // Stok negatif olmamalı
                        $product->save();
                    }
                }

                $installmentCount = (int) $order->taksit;
                $totalPrice = str_replace('.', '', $request->toplam_tutar);
                $totalPrice = str_replace(',', '.', $totalPrice);
                $totalPrice = floatval($totalPrice);
                $installmentAmount = $totalPrice / $installmentCount;
                $firstInstallmentDate = now()->addMonths();

                for ($i = 1; $i <= $installmentCount; $i++) {
                    Installments::create([
                        'order_id' => $order->id,
                        'user_id' => $order->user_id,
                        'taksit_no' => $i,
                        'amount' => $installmentAmount,
                        'due_date' => $firstInstallmentDate->copy()->addMonths($i - 1),
                        'status' => 0
                    ]);
                }

                return response()->json([
                    'success' => 'Sipariş Onaylandı',
                    'redirect_url' => route('order.index')
                ]);

            case 'reject':
                $order->status = '3';
                $order->save();

                return response()->json([
                    'success' => 'Sipariş Reddedildi',
                    'redirect_url' => route('order.index')
                ]);

            default:
                return response()->json(['error' => 'Geçersiz işlem!']);
        }
    }

}
