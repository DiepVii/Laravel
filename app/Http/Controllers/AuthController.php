<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Admin_Role;
use App\Models\Role;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
class AuthController extends Controller
{
    public function register_auth(){
        return view('admin.custom_auth.register');
    }
    public function register(Request $request){
        $data=$request->all();
        $admin = new Admin();
        $admin->admin_name=$data['admin_name'];
        $admin->admin_phone=$data['admin_phone'];
        $admin->admin_email=$data['admin_email'];
        $admin->admin_password=md5($data['admin_password']);
        $admin->save();
        return redirect('/admin')->with('message','Đăng kí thành công, mời bạn đăng nhập');
    }
    
}
