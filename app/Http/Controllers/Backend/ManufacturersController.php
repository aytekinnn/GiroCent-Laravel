<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Manufacturers;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    public function index(){
        $manufacturer = Manufacturers::get();
        return view('backend.manufacturers.index', compact('manufacturer'));
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $manufacturer = Manufacturers::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        if($manufacturer){
            return redirect()->route('manufacturer.index')->with('success','Yeni Üretici eklendi.');
        } else {
            return back()->with('error', 'Üretici Eklenemedi.');
        }
    }

    public function destroy($id){
        $manufacturer = Manufacturers::find($id);
        if ($manufacturer->delete()) {
            return back()->with('success', 'Üretici Silindi.');
        } else {
            return back()->with('error', 'Üretici Silinemedi.');
        }
    }

    public function edit(Request $request){
        $id = $request->get('id');
        $updateData = [
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'status' => $request->get('status')
        ];
        $manufacturer = Manufacturers::where('id',$id)->update($updateData);

        if ($manufacturer) {
            return back()->with('success', 'Güncelleme İşlemi Başarılı');
        } else {
            return back()->with('error', 'Güncellme İşlemi Başarısız');
        }
    }

    public function view(Request $request){
        $mid = $request->get('mid');
        $manufacturer = Manufacturers::find($mid);

        return view('backend.manufacturers.view', compact('manufacturer'));
    }
}
