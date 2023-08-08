<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function adminHome()
    {
        $product = Product::all();
        return view('adminHome',['products'=> $product]);
    }

    public function adminUser()
    {
        $user = User::all();
        return view('adminUser',['users'=> $user]);
    }

    
}