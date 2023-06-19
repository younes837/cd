<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Support\Facades\Auth;
use IlluminateSupportFacadesURL;
class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('app/ecommerce/shop');
        } else {
            return view('content/authentication/auth-login-basic');
        }
    }
    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()
                ->intended('home')
                ->with('message', 'Signed in!');
        }

        return redirect('/login')->with(
            'message',
            'Email or Password are not valid!'
        );
    }
    public function register()
    {
        if (Auth::check()) {
            return redirect('app/ecommerce/shop');
        } else {
            $villes=Ville::all();
                return view('content/authentication/auth-register-basic',compact('villes'));
        }
        
    }
    public function postsignup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'avatar' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        $file = $request->file('avatar');
        $name = $request->file('avatar')->getClientOriginalName();
        $file->move(public_path('/images/'), $name);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->adress,
            'password' => $request->password,
            'avatar' => $name,
            'role_id' => 2,
            'ville_id' => $request->ville,
        ];
        $check = $this->create($data);

        return redirect('login');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $data['avatar'],
            'phone' => $data['phone'],
            'adress' => $data['adress'],
            'ville_id' => $data['ville_id'],
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
