<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Informations;
use Illuminate\Http\Request;

class InformationsController extends Controller
{
    public function index(){
        $information = Informations::get();
        return view('backend.informations.index',compact('information'));
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);

        $manufacturer = Informations::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'description' => $request->description
        ]);

        if($manufacturer){
            return redirect()->route('informations.index')->with('success','Bilgi Sayfası Eklendi.');
        } else {
            return back()->with('error', 'Bilgi Sayfası Eklenemedi.');
        }
    }

    public function destroy($id){
        $information = Informations::find($id);
        if ($information->delete()) {
            return back()->with('success', 'Bilgi Sayfası Silindi.');
        } else {
            return back()->with('error', 'Bilgi Sayfası Silinemedi.');
        }
    }

    public function edit(Request $request){
        $id = $request->get('id');
        $updateData = [
            'title' => $request->get('title'),
            'slug' => $request->get('slug'),
            'status' => $request->get('status')
        ];
        $information = Informations::where('id',$id)->update($updateData);

        if ($information) {
            return back()->with('success', 'Güncelleme İşlemi Başarılı');
        } else {
            return back()->with('error', 'Güncellme İşlemi Başarısız');
        }
    }

    public function view(Request $request){
        $iid = $request->get('iid');
        $informations = Informations::find($iid);

        return view('backend.informations.view', compact('informations'));
    }
}
