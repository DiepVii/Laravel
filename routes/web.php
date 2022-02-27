<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend
Route::get('','HomeController@index');
Route::get('trang-chu','HomeController@index');
Route::post('tim-kiem','HomeController@search');

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@detail_product');


//backend
Route::get('admin','AdminController@index');
Route::get('dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin_dashboard','AdminController@dashboard');

//Category Product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');



Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');


Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');
Route::post('/save-category-product','CategoryProduct@save_category_product');

//Brand Product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');



Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');
Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');


Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');
Route::post('/save-brand-product','BrandProduct@save_brand_product');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');



Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/unactive-product/{product_id}','ProductController@unactive_product');


Route::post('/update-product/{product_id}','ProductController@update_product');
Route::post('/save-product','ProductController@save_product');

//cart
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{row_Id}','CartController@delete_to_cart');
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/gio-hang','CartController@gio_hang');

//check out
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout','CheckoutController@save_checkout');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');
Route::get('/delete-fee','CheckoutController@delete_fee');
Route::post('/confirm-order','CheckoutController@confirm_order');
Route::get('/info-delivery','CheckoutController@info_delivery');


//order 
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/manage-order','OrderController@manage_order');
// Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{order_id}','OrderController@view_order');
Route::post('/update-order-quantity','OrderController@update_order_quantity');

//send mail
Route::get('send-mail','HomeController@send_mail');

//check-coupon
Route::post('/check-coupon','CheckoutController@check_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/delete-coupon-home','CouponController@delete_coupon_home');
Route::get('/all-coupon','CouponController@all_coupon');
Route::post('/save-coupon','CouponController@save_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
 
//delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');

//Banner
Route::get('/manage-banner','SliderController@manage_banner');
Route::get('/add-slider','SliderController@add_slider');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slider/{slider_id}','SliderController@unactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
Route::get('/delete-slide/{slider_id}','SliderController@delete_slider');

//Import export
Route::post('/export-csv','CategoryProduct@export_csv');
Route::post('/import-csv','CategoryProduct@import_csv');

//Authentication roles
Route::get('/register-auth','AuthController@register_auth');
Route::post('/register','AuthController@register');
