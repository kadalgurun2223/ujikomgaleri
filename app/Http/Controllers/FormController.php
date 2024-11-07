<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User; //tidak boleh pake s
use Illuminate\Support\Facades\Hash;

class FormController extends Controller
{
    public function index(){
        return view('form');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()){
            if(Auth::attempt(
                ['email' => $request->email, 'password' => $request->password]
            )) {
                return redirect()->route('konten.index');
            } else {
                return redirect()->route('form')->with('error', 'Email Dan Password Salah');
            }
        } else {
            return redirect()->route('form')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function register(){
        return view('signup');
    }

    public function prosesRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->alamat = $request->alamat;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('form')->with('success', 'Berhasil register');
        } else {
            return redirect()->route('signup')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }


}
