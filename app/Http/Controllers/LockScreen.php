<?php

namespace GMC\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GMC\Http\Requests;

class LockScreen extends Controller {

    public function get() {
        if (Auth::check()) :
            Session::put('locked', true);
            return view('vendor.materialAdmin.auth.locked');
        endif;

        return redirect('/login');
    }

    public function post(Request $request) {
        if (Auth::check() == false) :
            return redirect('/login');
        endif;

        if (Illuminate\Support\Facades\Hash::check($request->input('password'), \Auth::user()->password)) :
            Session::forget('locked');
            return redirect('/dashboard');
        endif;

        //... handle the password mismatch errors
    }

}
