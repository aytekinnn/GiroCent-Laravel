<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Campaigns;
use App\Models\Products;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    public function index()
    {
        $campaign = Campaigns::with('product')->get();
        $product = Products::get();
        return view('backend.campaigns.index', compact('campaign', 'product'));
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'product_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
            'new_price' => 'required'
        ]);
        /** @var Campaigns $campaign */
        $campaign = new Campaigns();
        $campaign->name = $validateData['name'];
        $campaign->content = $request->contents ?? ' ';
        $campaign->product_id = $validateData['product_id'];
        $campaign->discount = $validateData['discount'];
        $campaign->start_date = $validateData['start_date'];
        $campaign->end_date = $validateData['end_date'];
        $campaign->new_price = $validateData['new_price'];
        $campaign->save();
        return redirect()->route('campaigns.index')->with('success', 'Kampanya Eklendi');
    }

    public function view(Request $request)
    {
        $caId = $request->input('caid');
        $campaign = Campaigns::where('id', $caId)->with('product')->first();
        $product = Products::where('durum', 1)->get();
        return view('backend.campaigns.view', compact('campaign','product'));
    }

    public function destroy($id){
        $campaign = Campaigns::find($id);
        if ($campaign->delete()) {
            return back()->with('success', 'Kampanya Silindi');
        } else {
            return back()->with('error', 'Kampanya Silinemedi');
        }
    }

    public function edit(Request $request) {
        $id = $request->get('id');
        $campaign = Campaigns::find($id);
        if (!$campaign) {
            return redirect()->back()->with('error', 'Kampanya Bulunamadı');
        }
        $validateData = $request->validate([
            'name' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount' => 'required|numeric|min:0|max:100',
            'new_price' => 'required|numeric|min:0'
        ]);

        $campaign->update([
            'name' => $validateData['name'],
            'content' => $request->contents ?? ' ',
            'product_id' => $validateData['product_id'],
            'discount' => $validateData['discount'],
            'start_date' => $validateData['start_date'],
            'end_date' => $validateData['end_date'],
            'new_price' => $validateData['new_price'],
            'status' => $request->status
        ]);
        return back()->with('success', 'Güncelleme İşlemi Başarılı');
    }
}
