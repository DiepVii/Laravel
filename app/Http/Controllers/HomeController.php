<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use Session;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index(){
        $slider=Slider::where('slider_status',1)->orderBy('slider_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        // $all_product=DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('product_id','desc')->get();
        // $manager_product=view('admin.all_product')->with('all_product',$all_product);
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
        return view('pages.home')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
        ->with('slider',$slider);
    }
    public function search(Request $request){
        $keywords=$request->keywords;
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $search_product=DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
        return view('pages.product.search')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('search_product',$search_product);
    }

    public function send_mail(){
        $to_name = "Diep Vi Day";
        $to_email = "vib1809209@student.ctu.edu.vn";//send to this email

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail khơi khơi"); //body of mail.blade.php
    
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
         //return Redirect::to('/')->with('message','');

    }
}
