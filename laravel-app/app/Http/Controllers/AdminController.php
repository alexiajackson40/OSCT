<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home() {
        return view('admin_user.home');
    }

    public function profile() {
        return view('admin_user.profile');
    }

    public function schedule() {
        return view('admin_user.schedule');
    }

    public function users() {
        return view('admin_user.users');
    }

    public function addUser() {
        return view('admin_user.add_user');
    }
}
