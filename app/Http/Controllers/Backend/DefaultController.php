<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DefaultController extends Controller
{
    public function index(){
        return view('backend.default.index');
    }

    public function login(){
        return view('backend.default.login');
    }

    public function register(){
        return view('backend.default.register');
    }

    public function authenticate(Request $request){
        $request->flash();
        $credentials=$request->only('email','password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials,$remember_me))
        {
            return redirect()->intended(route('home.index'));
        } else {
            return back()->with('error','Hatalı Kullanıcı');
        }
    }

    public function store(Request $request)
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
            'name' =>$request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'image' => $file_name,
            'phone' => $request->phone,
            'kvkk' => true,
            'terms' => true,
            'role_id' => 2,
            'two_factor_code' => random_int(100000, 999999),
        ]);

        if ($users) {
            return redirect(route('home.index'))->with('success', 'Kayıt İşlemi Başarıyla Tamamlandı.');
        } else {
            return back()->with('error', 'Kayıt İşlemi Başarısız');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect(route('home.index'));
    }
}
