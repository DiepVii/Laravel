<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
           return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $category_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        
        return view('admin.add_product')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('product_id','desc')->get();
        $manager_product=view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['product_price']=$request->product_price;
        $data['product_quantity']=$request->product_quantity;
        $data['product_desc']=$request->product_desc;
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->category_product;
        $data['brand_id']=$request->brand_product;
        $data['product_status']=$request->product_status;
        $data['product_sold']=$request->product_sold;
        
        $get_image=$request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-product');
        }
        $data['product_image']='';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Hiển thị sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $category_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product=view('admin.edit_product')->with('edit_product',$edit_product)->with('category_product',$category_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
       $data=array();
       $data['product_name']=$request->product_name;
       $data['product_price']=$request->product_price;
       $data['product_quantity']=$request->product_quantity;
       $data['product_desc']=$request->product_desc;
       $data['product_content']=$request->product_content;
       $data['category_id']=$request->category_product;
       $data['brand_id']=$request->brand_product;
       $data['product_sold']=$request->product_sold;
      
       
       $get_image=$request->file('product_image');
       if($get_image){
           $get_name_image=$get_image->getClientOriginalName();
           $name_image=current(explode('.',$get_name_image));
           $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/uploads/product',$new_image);
           $data['product_image']=$new_image;
           DB::table('tbl_product')->where('product_id',$product_id)->update($data);
           Session::put('message','Cập nhật sản phẩm thành công');
           return Redirect::to('all-product');
       }
   
       DB::table('tbl_product')->where('product_id',$product_id)->update($data);
       Session::put('message','Cập nhật sản phẩm thành công');
       return Redirect::to('all-product');

       
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //end admin page
    public function detail_product($product_id){
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $detail_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$product_id)->get();

        foreach ($detail_product as $key=> $value){
            $category_id=$value->category_id;
        }
        $relate_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_category_product.category_id',$category_id)->whereNotIn('product_id',[$product_id])->get();   
        
        return view('pages.product.detail_product')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('detail_product',$detail_product)
        ->with('relate_product',$relate_product);
    }
}
