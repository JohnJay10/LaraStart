<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function about(){
        return view('about');
    }

     public function home(){
        return view('index');
     }

    

    public function contact(){
        return view('contact');
    }

    // public function login(){
    //     return view('auth.login');
    //     redirect('about');
    // }

    // public function register(){
    //     return view('auth.register');
    // }

  
    


}
