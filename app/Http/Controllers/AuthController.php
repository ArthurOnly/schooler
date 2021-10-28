<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginHandler(LoginRequest $request){
        if (Auth::attempt($request->validated(), $request->input('remember', false))){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        notify()->error('Credenciais incorretas.');
        return redirect()->route('auth.login')->withErrors(['message' => 'Login Error'])->withInput();
    }

    public function register(){
        return view('auth.register');
    }

    public function registerHandler(RegisterRequest $request){
        try{
            $user = User::create($request->all());
            $user->assignRole('client');
            Auth::login($user);
            return redirect('/dashboard');
        } catch(Exception $ex){
            return redirect()->route('auth.register')->withErrors(['message' => $ex->__toString()])->withInput($request->input());
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function noticeEmail(){
        return view('auth.mail-verification');
    }

    public function verifyEmail(EmailVerificationRequest $request){
        $request->fulfill();

        return redirect('dashboard');
    }

    public function sendVerification(){
        auth()->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
