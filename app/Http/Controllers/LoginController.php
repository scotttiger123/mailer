<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function index () {
         
        return view('auth.login');
    }
    
    function login (Request $request) { 
        
            $request->validate([
                'email'      => 'required',
                'password'     => 'required',
            ]);
            
            if(\Auth::attempt($request->only('email','password'))) {
                 return redirect('dashboard');
            }

            return redirect('login')->withError('Login details are not valid');
         
    }

    function register(){
        
        return view('auth.register');
    }

    function forgot(){
        
        return view('auth.forgot');
    }

    function forgot_pass(){
        
        return view('auth.forgot');
    }

    function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('login');
    }

    function register_user (Request $request) { 
        
        
        //  $validatedData = $request->validate([
        // //     'name'      => 'required|string|max:255',
        // //     'email'     => 'required|email|unique:users',
        // //     'password'  => 'required|string|min:4|confirmed',
        // //     // 'terms'     => 'accepted', 
        //  ]);
        
        // Create a new user instance
        $user = new User();
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
    
        if(\Auth::attempt($request->only('email','password'))) {
            return redirect('welcome');
        }
        
    
    }
}
