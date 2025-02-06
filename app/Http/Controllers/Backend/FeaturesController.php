<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faetures;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index(){
        $feature = Faetures::where('status', 1)->get();
        $features = Faetures::where('status', 1)
            ->where('ust_id', null)
            ->get();
        return view('backend.features.index', compact('feature', 'features'));
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $features = Faetures::create([
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
        $features = Faetures::find($id);
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
        $features = Faetures::where('id', $id)->update($updateData);

        if ($features) {
            return back()->with('success', 'Güncelleme İşlemi Başarılı');
        } else {
            return back()->with('error', 'Güncelleme İşlemi Başarısız');
        }
    }

    public function view(Request $request){
        $fid = $request->get('fid');
        $features = Faetures::where('id', $fid)->first();
        $ust_id = $features->ust_id;
        $featuries = Faetures::where('status', 1)->get();

        return view('backend.features.view', compact('features', 'ust_id', 'featuries'));
    }
}
