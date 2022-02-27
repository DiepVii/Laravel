<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
class CartController extends Controller
{
    public function gio_hang(){
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.cart_ajax')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $val['product_qty']+=$data['cart_product_qty'];
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }  

    public function save_cart(Request $request){
    

        $product_id=$request->product_id_hidden;
        $quantity=$request->qty;

        $product_info=DB::table('tbl_product')->where('product_id',$product_id)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id']=$product_info->product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['weight']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(0);
        return Redirect::to('/show-cart');
        // Cart::destroy();
    }
    public function show_cart(){
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function delete_to_cart($rowId){
            Cart::update($rowId,0);
            return redirect()->back();
    }
    public function update_cart_quantity(Request $request){
        $rowId=$request->row_Id;
        $qty=$request->quantity;
        Cart::update($rowId,$qty);
        return redirect()->back();
    }
}
