<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    public function index(){
        $slider = Sliders::get();
        return view('backend.slider.index',compact('slider'));
    }

    public function create(Request $request){
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,png,jpeg|max:5048']);
            $file_name = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/slider'), $file_name);
        } else {
            return back()->with('error', 'Lütfen Resim Seçiniz');
        }

        $slider = Sliders::create([
            'image' => $file_name,
            'order' => $request->order,
            'status' => $request->status,
            'title' => $request->title,
            'content' => $request->input('content')
        ]);

        if ($slider){
            return redirect()->route('slider.index')->with('success','Slider Eklendi');
        } else {
            return back()->with('error','Slider Eklenemedi');
        }
    }

    public function destroy($id){
        $slider = Sliders::find($id);
        if ($slider->delete()) {
            return back()->with('success', 'Silme İşlem Başarılı');
        } else {
            return back()->with('error', 'İşlem Başarısız');
        }
    }

    public function edit(Request $request){
        $id = $request->input('id');
        $updateData = [
            'order' => $request->get('order'),
            'status' => $request->get('status'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ];
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,png,jpeg|max:5048']);
            $file_name = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/slider'), $file_name);
            $updateData['image'] = $file_name;
        } else {
            $updateData['image'] = $request->old_file;
        }

        $slider = Sliders::where('id', $id)->update($updateData);

        if ($slider) {
            if ($request->hasFile('image')) {
                $path = 'images/slider/' . $request->old_file;
                if (file_exists($path)) {
                    @unlink(public_path($path));
                }
            }
            return back()->with("success", "Düzenleme İşlemi Başarılı");
        } else {
            return back()->with("error", "Düzenleme İşlemi Başarısız");
        }
    }

    public function view(Request $request){
        $sid = $request->input('sid');
        $slider = Sliders::find($sid);
        return view('backend.slider.view',compact('slider'));
    }
}
