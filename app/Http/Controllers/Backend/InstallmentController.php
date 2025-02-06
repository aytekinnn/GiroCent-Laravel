<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Installments;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {
        $installments = Installments::all()->groupBy(function($item) {
            return $item->user_id . '-' . $item->order_id . '-' . $item->product_id;
        });

        $date = now();
        $installmentData = [];

        foreach ($installments as $groupKey => $group) {
            list($user_id, $order_id, $product_id) = explode('-', $groupKey);

            $userName = \App\Models\User::find($user_id)->name; // Kullanıcı adını al

            $paidInstallments = $group->where('status', 1)->count();
            $totalInstallments = $group->count();

            $lastInstallment = $group->last();
            $nextPaymentDate = $group->where('status', 0)->first()->due_date ?? null;

            $statusText = '';
            if ($nextPaymentDate && $nextPaymentDate < $date) {
                $statusText = 'Günü Geçmiş';
            } elseif ($paidInstallments === $totalInstallments) {
                $statusText = 'Ödendi';
            } elseif ($nextPaymentDate && $nextPaymentDate > $date) {
                $statusText = 'Yaklasiyor';
            } else {
                $statusText = 'Ödenmedi';
            }
            $firstInstallmentId = $group->first()->id;

            $installmentData[] = [
                'user_id' => $user_id,
                'order_id' => $order_id,
                'product_id' => $product_id,
                'user_name' => $userName, // Kullanıcı adı veriye ekleniyor
                'paidInstallments' => $paidInstallments,
                'totalInstallments' => $totalInstallments,
                'nextPaymentDate' => $nextPaymentDate,
                'status' => $statusText,
                'firstInstallmentId' => $firstInstallmentId
            ];
        }

        return view('backend.installment.index', compact('installmentData', 'date'));
    }

    public function views($id){
        $installment = Installments::findOrFail($id);
        $date = now();

        $installments = Installments::where('user_id', $installment->user_id)
            ->with('user')
            ->where('order_id', $installment->order_id)
            ->where('product_id', $installment->product_id)
            ->get();



        return view('backend.installment.view', compact('installments', 'date'));
    }

    public function view(Request $request){
        $tid = $request->get('tid');
        $installment = Installments::where('id', $tid)->first();

        return view('backend.installment.edit', compact('installment'));
    }

    public function edit(Request $request){
        $id = $request->get('id');
        $updateData = [
            'status' => $request->get('status'),
        ];
        $features = Installments::where('id', $id)->update($updateData);

        if ($features) {
            return back()->with('success', 'Güncelleme İşlemi Başarılı');
        } else {
            return back()->with('error', 'Güncelleme İşlemi Başarısız');
        }
    }

}
