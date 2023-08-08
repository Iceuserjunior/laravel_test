<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index(){
        return view('product.index',['products'=>Product::latest()->paginate(5)]);
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){

        $request->validate([

            'name' => 'required',
            'total' => 'required',
            'title' => 'required',
            'price' => 'required',
            'image' => 'required|max:1000',

        ]);


        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'),$imageName);

        $product = new Product;
        $product->name = $request->name;
        $product->total = $request->total;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->image = $imageName;
        
        $product->save();
        return back()->withSuccess('บันทึกสินค้าสำเร็จ');
    }

    public function edit($id){
        $product = Product::where('id',$id)->first();
        return view('product.edit',['product'=>$product]);
    }

    public function update(Request $request,$id){

        $request->validate([

            'name' => 'required',
            'total' => 'required',
            'title' => 'required',
            'price' => 'required',
            'image' => 'nullable|max:1000',

        ]);

        $product = Product::where('id',$id)->first();

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'),$imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->total = $request->total;
        $product->title = $request->title;
        $product->price = $request->price;
        
        
        $product->save();
        return redirect()->route('adminHome')->withSuccess('แก้ไขสินค้าสำเร็จ');
    }

    public function delete($id){

        $product = Product::where('id',$id)->first();
        
        $product->delete();

        return redirect()->route('adminHome')->with('success','ลบสินค้าสำเร็จ');

    }


    //add to cart
    public function addToCart(Request $request){

        $cart = new Cart;
        
        $cart->user_id = $request->user_id;

        $cart->product_id =$request->product_id;

        $cart->save();

        return redirect('/user/index')->with('success','สั่งซื้อสำเร็จ');
    }

    public function shopList(){


        $userId = Auth::user()->id;

        $product = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();
        
        return view('shoplist',['products'=>$product]);


    }

    public function removeCart($id){

        Cart::destroy($id);
        return redirect('shoplist');

    }





}
