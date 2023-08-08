<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Models\User;

class UserCardController extends Controller

{
    public function index(){

        $product = Product::all();
        return view('user/index',['products'=> $product]);
    }

    public function edit($id){
        $user = User::where('id',$id)->first();
        return view('user.edit',['users'=>$user]);
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::where('id',$id)->first();

        $user->name = $request->name;
        $user->email = $request->email;

        
        $user->save();
        return redirect()->route('adminUser')->withSuccess('แก้ไขสมาชิกสำเร็จ');
    }


}
