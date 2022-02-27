@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ ĐƠN HÀNG
    </div>
   
    <div class="table-responsive">
    <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Số thứ tự</th>
           
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng </th>
            <th>Tình trạng đơn hàng</th>
            <th>Sửa xóa</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=0;
          ?>
          @foreach($order as $key =>$ord)
            <?php
              $i++;
            ?>
          <tr>
            <td><label><i>{{$i}}</i></label></td>
            <td>{{$ord->order_code}}</td>
            <td>{{$ord->created_at}}</td>
            <td>
                <?php
                  if($ord->order_status==1) 
                  echo('Đơn hàng mới');
                   elseif($ord->order_status==2)
                   echo('Đã giao hàng và tính tiền');
                   elseif($ord->order_status==4)
                   echo('Đã xác nhận đơn hàng');
                   else  echo('Đã hủy đơn');
                ?>
            </td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>
              
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection