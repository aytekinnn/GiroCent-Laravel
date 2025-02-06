<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Installments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstallmentController extends Controller
{
    public function index()
    {
        $installments = Installments::all()->where('user_id', Auth::user()->id)->groupBy(function($item){
            return $item->user_id . '-' . $item->order_id;
        });

        $date = now();
        $installmentData = [];

        foreach ($installments as $groupKey => $group) {
            list($user_id, $order_id) = explode('-', $groupKey);
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
              'paidInstallments' => $paidInstallments,
              'totalInstallments' => $totalInstallments,
              'nextPaymentDate' => $nextPaymentDate,
              'status' => $statusText,
              'firstInstallmentId' => $firstInstallmentId
            ];
        }
        return view('frontend.installment.index', compact('installmentData', 'date'));
    }

    public function viewer($id){
        $installment = Installments::findOrFail($id);
        $date = now();

        $installments = Installments::where('user_id', $installment->user_id)
            ->with('user')
            ->where('order_id', $installment->order_id)
            ->get();
        return view('frontend.installment.view', compact('installments', 'date'));
    }
}
