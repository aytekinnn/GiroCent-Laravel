<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campaigns;
use App\Models\Carts;
use App\Models\Categories;
use App\Models\Informations;
use App\Models\Products;
use App\Models\Sliders;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DefaultController extends Controller
{
    public function index()
    {
        $slider = Sliders::where('status', 1)->get();
        $oneProduct = Products::where('durum', 1)
            ->where('one_cikar', 1)
            ->with(['campaigns'])
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();
        $product = Products::where('durum', 1)
            ->orderBy('id', 'desc')
            ->with(['campaigns'])
            ->limit(8)
            ->get();
        $campaign = Campaigns::where('status', 1)
            ->with(['product'])
            ->get();
        $categories = Categories::where('status', 1)
            ->whereNull('ust_id')
            ->with('subCategories')
            ->get();
        $kampanya = Campaigns::where('status', 1)
            ->with(['product'])
            ->orderBy('created_at', 'desc')
            ->first();
        foreach ($campaign as $campaigns) {
            $currentDateTime = Carbon::now('Europe/Istanbul');
            if ($campaigns->start_date <= $currentDateTime) {
                $validCampaigns[] = $campaigns;
            }
        }
        return view('frontend.default.index', compact('slider', 'oneProduct', 'validCampaigns', 'product', 'categories', 'kampanya'));
    }

    public function documentDetail($id)
    {
        return view('frontend.default.belge');
    }

    public function login()
    {
        return view('frontend.default.login');
    }

    public function about()
    {
        return view('frontend.default.about');
    }

    public function contact()
    {
        return view('frontend.default.contact');
    }

    public function register()
    {
        return view('frontend.default.register');
    }

    public function auth(Request $request)
    {
        $request->flash();
        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            if (Auth::user()->status == 2){
                Auth::logout();
                return back()->with('error', 'Admin tarafından siteye erişiminiz sınırlandırıldı. Admin ile iletişime geçiniz');
            }
            return redirect('/');
        } else {
            return back()->with('error', 'Hatalı Kullanıcı');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:password1',
            'password1' => 'required'
        ], [
            'email.unique' => 'Bu e-posta adresi zaten kayıtlı.',
            'password1.same' => 'Şifreler aynı değil!'
        ]);

        if ($request->hasfile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);
            $file_name = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/user'), $file_name);
        } else {
            $file_name = null;
        }

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $file_name,
            'phone' => $request->phone,
            'kvkk' => true,
            'terms' => true,
            'role_id' => 2,
            'two_factor_code' => random_int(100000, 999999),
            'ip' => $request->ip(),
        ]);

        if ($users) {
            Auth::login($users);

            $sessionCart = session()->get('cart', []);

            if (!empty($sessionCart)) {
                foreach ($sessionCart as $id => $item) {
                    $cartItem = Carts::where('user_id', $users->id)->where('product_id', $id)->first();
                    if ($cartItem) {
                        $cartItem->increment('quantity', $item['quantity']);
                    } else {
                        // ⿣ Ürün sepette yoksa yeni kayıt oluştur
                        Carts::create([
                            'user_id' => $users->id,
                            'product_id' => $id,
                            'name' => $item['name'],
                            'price' => $item['price'],
                            'quantity' => $item['quantity'],
                            'image' => $item['image']
                        ]);
                    }
                }
                session()->forget('cart');

                return redirect()->route('cart.index')->with('success', 'Kayıt tamamlandı, sepetinize yönlendiriliyorsunuz.');
            }
            return redirect()->route('login.front')->with('success', 'Kayıt işlemi başarıyla tamamlandı.');
        } else {
            return back()->with('error', 'Kayıt işlemi başarısız.');
        }

    }

    public function account()
    {
        $user = Auth::user();
        return view('frontend.default.account', compact('user'));
    }

    public function accountPost(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password1' => 'nullable|min:8|same:password2',
            'password2' => 'nullable',
        ], [
            'password1.same' => 'Şifreler aynı değil!'
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            // Eski resmi sil
            if ($user->image) {
                $oldImagePath = public_path('images/user/' . $user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Yeni resmi kaydet
            $file_name = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/user'), $file_name);
            $user->image = $file_name;
        } else {
            $user->image = $request->get('old_image', $user->image);
        }

// Kullanıcı bilgilerini güncelle
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');

// Eğer yeni şifre girilmişse güncelle, yoksa eski şifreyi koru
        if ($request->filled('password1')) {
            $user->password = Hash::make($request->get('password1'));
        }

        if ($user->save()) {
            return back()->with('success', 'Güncelleme İşlemi Başarılı');
        } else {
            return back()->with('error', 'Güncelleme İşlemi Başarısız');
        }

    }
}
