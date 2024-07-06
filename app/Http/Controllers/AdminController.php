<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    /**
     * Method index
     * This is for show the login Page     
     *
     * @return
     */
    public function index()
    {
        return view('Auth.login');
    }

    /**
     * Method authLogin
     * This is for the Login Authentication 
     *  
     * @param Request $request [explicite description]
     *
     * @return 
     */
    public function authLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

                if (Auth::guard('admin')->user()->role != 'admin') {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You are not authorize to use this page');
                }

                return redirect()->route('home');

            } else {
                return redirect()->route('admin.login')->with('error', 'Invalid Credentials');
            }

        } else {
            return redirect()->route('admin.login')
                ->withInput()
                ->withErrors($validator);
        }
    }


    /**
     * Method logout
     * This is for the Logout 
     *
     * @return void
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
