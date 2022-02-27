<?php

namespace App\Http\Controllers;
use App\Models\Coupon;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use PDF;
use Illuminate\Support\Facades\Redirect;
class OrderController extends Controller
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
    public function update_order_quantity(Request $request){
        $data=$request->all();
        $order=Order::find($data['order_id']);
        $order->order_status=$data['order_status'];
        $order->save();

        if($order->order_status==2){
            foreach($data['order_product_id'] as $key =>$product_id){
                $product=Product::find($product_id);
                $product_quantity=$product->product_quantity;
                $product_sold=$product->product_sold;
                foreach($data['quantity'] as $key2 =>$quantity){
                    if($key==$key2){
                        $pro_remain=$product_quantity-$quantity;
                        $product->product_quantity=$pro_remain;
                        $product->product_sold=$product_sold+$quantity;
                        $product->save();
                    }
                }
            }
        }
    }
    public function print_order($checkout_code){
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details=OrderDetails::where('order_id',$checkout_code)->get();
        $order=Order::where('order_id',$checkout_code)->get();
        foreach($order as $key=> $ord){
            $customer_id=$ord->customer_id;
            $shipping_id=$ord->shipping_id;
        }
        $customer=Customer::where('customer_id',$customer_id)->first();
        $shipping=Shipping::where('shipping_id',$shipping_id)->first();
        $order_details=DB::table('tbl_order')  
        ->join('tbl_order_detail','tbl_order_detail.order_id','=','tbl_order.order_id')
        ->join('tbl_product','tbl_order_detail.product_id','=','tbl_product.product_id')
        ->where('tbl_order.order_id',$checkout_code)
        ->select('tbl_order_detail.*','tbl_product.product_price as pro_price','product_image')
        ->get();
        foreach($order_details as $key => $order_d){
            $product_coupon=$order_d->product_coupon;
        }
        if($product_coupon!='0'){
            $coupon=Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition=$coupon->coupon_condition;
            $coupon_number=$coupon->coupon_number;
        }
        else{
            $coupon_condition=2;
            $coupon_number=0;
        }

        $output='';
        $output.='
        <style>
          body{ font-family:DejaVu Sans;}
          .table-styling{
              border:1px solid black;
          }
          .table-styling tbody tr td{
            border:1px solid black;
            }
        </style>
        <h1><center>Shop quần áo Diệp Vĩ</center></h1>

        <p>Thông tin khách hàng</p>
        <table class="table-styling" >
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>';
           
        $output.='
                <tr>
                    <td>'.$customer->customer_name.'</td>
                    <td>'.$customer->customer_phone.'</td>
                    <td>'.$customer->customer_email.'</td>
                </tr>'; 
            
        $output.='
            </tbody>
        </table>
      
        <p>Thông tin nhận hàng</p>
        <table class="table-styling" >
            <thead>
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>';
           
        $output.='
                <tr>
                    <td>'.$shipping->shipping_name.'</td>
                    <td>'.$shipping->shipping_address.'</td>
                    <td>'.$shipping->shipping_phone.'</td>
                    <td>'.$shipping->shipping_notes.'</td>
                </tr>'; 
            
        $output.='
            </tbody>
        </table>

        <p>Đơn hàng</p>
        <table class="table-styling" >
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Mã giảm giá</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>';
        $total=0;
        
       foreach($order_details as $key =>$product){
        if($product->product_coupon!='0'){
            $product_coupon=$product->product_coupon;
          }  
          else{
            $product_coupon='Không có mã giảm giá';
          }
       
            $subtotal=$product->product_price*$product->product_quantity;
            $total+=$subtotal;
    $output.='
            <tr>
                <td>'.$product->product_name.'</td>
                <td>'.$product->product_quantity.'</td>
                <td>'.number_format($product->product_price, 0, '.', '.'). ' VNĐ'.'</td>
                <td>'.$product_coupon.'</td>
                <td>'.number_format($subtotal, 0, '.', '.'). ' VNĐ'.'</td>
            </tr>'; 
        }
        if($coupon_condition==1){
            $total_coupon=($total*$coupon_number)/100;

        }else{
          $total_coupon=$coupon_number;
        }
    $output.='<tr>
      
        <td colspan="5">
            <p>Giảm giá: '.number_format($total_coupon, 0, '.', '.'). ' VNĐ'.'</p>
            <p>Phí vận chuyển: '.number_format($product->product_feeship, 0, '.', '.'). ' VNĐ'.'</p>
            <p>Tổng tiền: '.number_format($total-$total_coupon+$product->product_feeship, 0, '.', '.'). ' VNĐ'.' </p>
        </td>
    </tr>
    ';
    $output.='
        </tbody>
    </table>

    <p>Kí tên</p>
        <table >
            <thead>
                <tr>
                    <th width="200px">Người lập phiếu</th>
                    <th width="800px">Người nhận</th>
                   
                </tr>
            </thead>
            <tbody>';
           
    
            
        $output.='
            </tbody>
        </table>
        ';
        return $output;
    }
    public function view_order($order_id){
        $order_details=OrderDetails::where('order_id',$order_id)->get();
        $order=Order::where('order_id',$order_id)->get();
        foreach($order as $key=> $ord){
            $customer_id=$ord->customer_id;
            $shipping_id=$ord->shipping_id;
        }
        $customer=Customer::where('customer_id',$customer_id)->first();
        $shipping=Shipping::where('shipping_id',$shipping_id)->first();

        $order_details=DB::table('tbl_order')  
        ->join('tbl_order_detail','tbl_order_detail.order_id','=','tbl_order.order_id')
        ->join('tbl_product','tbl_order_detail.product_id','=','tbl_product.product_id')
        ->where('tbl_order.order_id',$order_id)
        ->select('tbl_order_detail.*','tbl_product.product_price as pro_price','product_image','tbl_product.product_quantity as pro_quantity')
        ->get();
        foreach($order_details as $key => $order_d){
            $product_coupon=$order_d->product_coupon;
        }
        if($product_coupon!='0'){
            $coupon=Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition=$coupon->coupon_condition;
            $coupon_number=$coupon->coupon_number;
        }
        else{
            $coupon_condition=2;
            $coupon_number=0;
        }
      

       
       
        return view('admin.view_order')->with(compact('order_details','customer','shipping','coupon_condition','coupon_number','order'));
    }
    public function manage_order(){
        $this->AuthLogin();
        $order=Order::orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
}
