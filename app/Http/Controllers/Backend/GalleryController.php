<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery($id)
    {
        $gallery=Gallery::where('product_id', $id)->get();
        return view('backend.products.gallery', compact('gallery','id'));
    }

    public function delete(Request $request)
    {
        $imageIds = $request->input('images');

        $images = Gallery::whereIn('id', $imageIds)->get();

        Gallery::whereIn('id', $imageIds)->delete();

        foreach ($images as $image) {
            $filePath = public_path('images/gallery/' . $image->galeri_yol);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        return back()->with('success', 'İşlem Başarılı');
    }

    public function galleryadd($id)
    {
        $gallery=Gallery::all();
        return view('backend.products.gallery-add', compact('gallery','id'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'product_id' => 'required',
        ]);

        $imageName = time() . '_' . uniqid() . '.' . $request->file->extension(); // Benzersiz dosya adı
        $request->file->move(public_path('images/gallery'), $imageName);

        $gallery = new Gallery();
        $gallery->product_id = $request->product_id;
        $gallery->galeri_yol = $imageName;
        $gallery->save();

        return response()->json(['status' => 'success', 'image' => $gallery]);
    }
}
