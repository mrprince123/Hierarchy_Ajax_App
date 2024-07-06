<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmpAuthController extends Controller
{
    /**
     * Method index
     * This is for show the login Page     
     *
     * @return
     */
    public function index()
    {
        return view('Employee.Auth.login');
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

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Show the Condition and navigate to one page
                return redirect()->route('employee.home');

            } else {
                return redirect()->route('employee.login')->with('error', 'Invalid Credentials');
            }

        } else {
            return redirect()->route('employee.login')
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Method register
     *
     * @return 
     */
    public function register()
    {
        return view('Employee.Auth.register');
    }


    /**
     * Method authRegister
     *
     * @param Request $request [explicite description]
     *
     * @return
     */
    public function authRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->passes()) {

            $employee = new User();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->password = Hash::make($request->password);
            $employee->role = 'employee';
            $employee->save();

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Show the Condition and navigate to one page
                return redirect()->route('employee.home');
            } else {
                return redirect()->route('employee.register')->with('error', 'Invalid Credentials');
            }

        } else {
            return redirect()->route('employee.register')
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
        Auth::logout();
        return redirect()->route('employee.login');
    }
}
