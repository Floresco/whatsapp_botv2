<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use Illuminate\View\View;
use Session;

class AuthController extends BaseController
{

    public function showLoginForm()
    {
        return view('auth.login',['title' => trans('messages.login')]);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (\Auth::attempt(['phone' => $validated['phone_email'], 'password' => $validated['password']]) || \Auth::attempt(['email' => $validated['phone_email'], 'password' => $validated['password']])) {
            Session::flash('success', trans('messages.welocome'));
            return redirect()->route('dashboard');
        } else {
            Session::flash('error', trans('auth.failed'));
            return back();
        }
    }

    public function logout() {
        Session::flush();
        \Auth::user()->tokens()->delete();
        \Auth::logout();
    }
}
