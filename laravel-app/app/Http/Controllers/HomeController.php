<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method to show the home page
    public function home()
    {
        return view('home');
    }

    // Method to show the login page
    public function login()
    {
        return view('login');
    }
}
