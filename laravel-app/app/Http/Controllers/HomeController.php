<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method to show the home page
    public function home()
    {
        return view('home'); // View located at resources/views/home.blade.php
    }

    // Method to show the login page
    public function login()
    {
        return view('login'); // View located at resources/views/login.blade.php
    }
}
