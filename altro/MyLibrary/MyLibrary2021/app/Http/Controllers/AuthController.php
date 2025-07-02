<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function authentication() {

        return view('auth.auth');
    }

    public function logout() {

        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }
    
    public function login(Request $request) {
        
        session_start();
        $dl = new DataLayer();
        
        if ($dl->validUser($request->input('username'), $request->input('password'))) 
        {
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->input('username');
            return Redirect::to(route('book.index'));

        }
       
        return view('auth.authErrorPage');
    }
    
    public function registration(Request $request) {
        $dl = new DataLayer();
        
        $dl->addUser($request->input('username'), $request->input('password'), $request->input('email'));
       
        return Redirect::to(route('user.login'));
    }    
}
