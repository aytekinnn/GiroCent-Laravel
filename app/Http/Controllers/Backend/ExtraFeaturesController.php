<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExtraFeatures;
use Illuminate\Http\Request;

class ExtraFeaturesController extends Controller
{
    public function index(){
        $feature = ExtraFeatures::where('status', 1)->get();
        $features = ExtraFeatures::where('status', 1)
            ->where('ust_id', null)
            ->get();
        return view('backend.extra-features.index', compact('feature', 'features'));
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $features = ExtraFeatures::create([
            'name' => $request->name,
            'status' => $request->status,
            'ust_id' => $request->ust_id,
        ]);

        if($features){
            return redirect()->back()->with('success', 'Özellik Eklendi');
        } else {
            return back()->with('error', 'Özellik Eklenemedi');
        }
    }

    public function destroy($id){
        $features = ExtraFeatures::find($id);
        if ($features->delete()) {
            return back()->with('success', 'Kategori Silindi');
        } else {
            return back()->with('error', 'Kategori Silinemedi');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $updateData = [
            'name' => $request->get('name'),
            'status' => $request->get('status'),
            'ust_id' => $request->get('ust_id'),
        ];
        $features = ExtraFeatures::where('id', $id)->update($updateData);

        if ($features) {
            return back()->with('success', 'Güncelleme İşlemi Başarılı');
        } else {
            return back()->with('error', 'Güncelleme İşlemi Başarısız');
        }
    }

    public function view(Request $request){
        $fid = $request->get('fid');
        $features = ExtraFeatures::where('id', $fid)->first();
        $ust_id = $features->ust_id;
        $featuries = ExtraFeatures::where('status', 1)->get();

        return view('backend.extra-features.view', compact('features', 'ust_id', 'featuries'));
    }
}
