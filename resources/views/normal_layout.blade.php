<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | DiepviShop</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0123456789</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> diepvi@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/trang-chu')}}"><img src="{{URL::to('public/frontend/images/logo.png')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
							
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id!=NULL && $shipping_id==Null){
										
									
								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}elseif($customer_id!=Null && $shipping_id!=Null){

								?>
								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}else{ 	?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
										<?php }?>
								

								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$customer_name=Session::get('customer_name');
									if($customer_id!=NULL){
										
									
								?>
								
								
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> {{$customer_name}} (Đăng xuất) </a></li>
								
								<?php
									}else{ 	?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
										<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="{{URL::to('/show-cart')}}">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
						
                                    </ul>
                                </li> 
								<li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/tim-kiem')}}" method="post">
							{{csrf_field()}}
							<div class="search_box pull-right">
								<input type="text" name="keywords" placeholder="Tìm kiếm sản phẩm"/>
								<input type="submit" style="" name="search_item" class="btn btn-info btn-sm" value="Tìm kiếm "/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<br> <br> <br>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category_product as $key =>$category)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$category->category_id)}}">{{$category->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							@foreach($brand_product as $key => $brand)
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
								</ul>
							</div>
							@endforeach
						</div><!--/brands_products-->
						
						
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">

					@yield('content')

					
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{URL::to('public/frontend/images/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
   
	<script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<script>type="text/javascript"
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id=$(this).data('id_product');
				var product_id_hidden =$('.cart_product_id_'+id).val();
				// var cart_product_name =$('.cart_product_name_'+id).val();
				// var cart_product_image =$('.cart_product_image_'+id).val();
				// var cart_product_price =$('.cart_product_price_'+id).val();
				var qty =$('.cart_product_qty_'+id).val();
			
				var _token = $('input[name="_token"]').val();
			 

				$.ajax({
					url: '{{url('/save-cart')}}',
                    method: 'POST',
					data:{product_id_hidden:product_id_hidden,qty:qty,_token:_token},
					success:function(data){
						swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/show-cart')}}";
                            });

					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.choose').on('change',function(){
            var action=$(this).attr('id');
            var ma_id=$(this).val();
            var _token=$('input[name="_token"]').val();
            var result='';
            
            if(action=='city'){
                result='province';
            }
            else{
                result='wards';
            }
            $.ajax({
                url: '{{url('/select-delivery-home')}}',
                method:'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
	});
		 
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.calculate_delivery').click(function(){
				var matp=$('.city').val();
				var maqh=$('.province').val();
				var maxp=$('.wards').val();
				var _token=$('input[name="_token"]').val();
				if(matp=='' || maqh=='' || maxp==''){
					alert('Chọn địa chỉ để tính phí vận chuyển');
				}
				else{
					$.ajax({
						url: '{{url('/calculate-fee')}}',
						method:'POST',
						data:{matp:matp,maqh:maqh,maxp:maxp,_token:_token},
						success:function(data){
							location.reload();
						}
            		});
				}
				
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.send_order').click(function(){
				swal({
				title: "Xác nhận đơn hàng",
				text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt chứ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Cảm ơn, mua hàng",
				cancelButtonText: "Không",
				closeOnConfirm: false,
				closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						var shipping_email =$('.shipping_email').val();
						var shipping_name =$('.shipping_name').val();
						var shipping_phone =$('.shipping_phone').val();
						var shipping_address =$('.shipping_address').val();
						var shipping_notes =$('.shipping_notes').val();
						var shipping_method =$('.payment_select').val();
						var order_fee =$('.order_fee').val();
						var order_coupon =$('.order_coupon').val();
						var _token = $('input[name="_token"]').val();
					

						$.ajax({
							url: '{{url('/confirm-order')}}',
							method: 'POST',
							data:{shipping_method:shipping_method,shipping_email:shipping_email,shipping_name:shipping_name,shipping_phone:shipping_phone,shipping_address:shipping_address,shipping_notes:shipping_notes,order_fee:order_fee,order_coupon:order_coupon,_token:_token},
							success:function(data){
								swal("Đơn hàng", "Đơn hàng của bạn đã được xác nhận", "success");

							}
						});
						window.setTimeout(function(){
							location.reload();
						},3000);
						
					}else {
						swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
					}
			
				});
								
				
			});
		});
	</script>
</body>
</html>