<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = Categories::where('status',1)
            ->get();
        $categories = Categories::where('status',1)
            ->where('ust_id', null)
            ->get();
        return view('backend.category.index', compact('category', 'categories'));
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($request->hasFile('icon')){
            $request->validate([
                'icon' => 'mimes:jpeg,jpg,png,gif|max:2048'
            ]);
            $file_name = uniqid() . '.' . $request->icon->getClientOriginalExtension();
            $request->icon->move(public_path('images/category'), $file_name);
        } else {
            $file_name = null;
        }

        $category = Categories::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'ust_id' => $request->ust_id,
            'order' => $request->order,
            'icon' => $file_name,
            'popular_category' => $request->popular_category
        ]);

        if ($category) {
            return redirect()->route('category.index')->with('success', 'Kategori Eklendi');
        } else {
            return back()->with('error', 'Kategori Eklenemedi');
        }
    }

    public function destroy($id){
        $category = Categories::find($id);
        if ($category->delete()) {
            return back()->with('success', 'Kategori Silindi');
        } else {
            return back()->with('error', 'Kategori Silinemedi');
        }
    }

    public function edit(Request $request){
        $id = $request->get('id');
        $cat = Categories::find($id);

        if (!$cat) {
            return back()->with('error', 'Kategori bulunamadı');
        }

        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'mimes:jpeg,jpg,png,gif|max:2048'
            ]);

            if ($cat->icon) {
                $oldImagePath = public_path('images/category/' . $cat->icon);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file_name = uniqid() . '.' . $request->icon->getClientOriginalExtension();
            $request->icon->move(public_path('images/category'), $file_name);
            $cat->icon = $file_name;
        } else {

            $cat->icon = $request->get('old_icon', $cat->icon);
        }

        $cat->name = $request->get('name');
        $cat->slug = $request->get('slug');
        $cat->status = $request->get('status');
        $cat->ust_id = $request->get('ust_id');
        $cat->order = $request->get('order');
        $cat->popular_category = $request->get('popular_category');

        if ($cat->save()) {
            return back()->with('success', 'Güncelleme İşlemi Başarılı');
        } else {
            return back()->with('error', 'Güncelleme İşlemi Başarısız');
        }
    }


    public function view(Request $request){
        $cid = $request->get('cid');
        $category = Categories::where('id', $cid)->first();
        $ust_id = $category->ust_id;
        $categories = Categories::where('status', 1)->get();

        return view('backend.category.view', compact('category', 'categories', 'ust_id'));
    }
}
