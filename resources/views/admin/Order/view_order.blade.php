@extends('admin_layout')
@section('admin_content')

<div class="container-fluid">
	<h3 class="title mt-4 text-center" style="font-weight: bold;">CHI TIẾT ĐƠN HÀNG</h3>
	@foreach($order_by_id as $key =>$value)
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<h4><b>Thông Tin Khách Hàng</b></h4>
					<div class="dropdown-divider"></div>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td width="30%">Họ Và Tên</td>
									<td width="70%">{{$value->HoTenKH}}</td>
								</tr>
								<tr>
									<td>Giới Tính</td>
									<td>
										<?php
										if($value->GioiTinh==0){
											echo 'Nữ';
										}elseif ($value->GioiTinh==1) {
											echo 'Nam';
										}else{
											echo 'Khác';
										}
										?>
									</td>
								</tr>
								<tr>
									<td>Ngày Sinh</td>
									<td>{{$value->Ngay.'/'.$value->Thang.'/'.$value->Nam}}</td>
								</tr>
								<tr>
									<td>Số Điện Thoại</td>
									<td>{{$value->SoDienThoai}}</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>{{$value->Email}}</td>
								</tr>
							</tbody>
						</table>
					</div>		
				</div>
				<div class="col-sm-6">
					<h4><b>Thông Tin Đơn Hàng</b></h4>
					<div class="dropdown-divider"></div>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td width="30%">Họ Và Tên</td>
									<td width="70%">{{$value->HoTen}}</td>
								</tr>
								<tr>
									<td>Địa Chỉ Giao Hàng</td>
									<td>{{$value->DiaChiGH}}</td>
								</tr>
								<tr>
									<td>Ngày Đặt Hàng</td>
									<td>{{\Carbon\Carbon::parse($value->NgayDH )->format('d/m/Y')}}</td>
								</tr>
								<tr>
									<td>Ngày Đặt Hàng</td>
									<td>
										@if($value->NgayGH==NULL)
										Chưa Giao Hàng
										@else
										{{\Carbon\Carbon::parse($value->NgayGH )->format('d/m/Y')}}
										@endif
									</td>
								</tr>
								<tr>
									<td>Số Điện Thoại</td>
									<td>{{$value->SDT}}</td>
								</tr>
								<tr>
									<td>Loại Giao Hàng</td>
									<td>
										@if($value->LoaiGH=='cash')
											Thanh Toán Khi Nhận Hàng
										@elseif($value->LoaiGH=='paypal')
											Thanh Toán Bằng PayPal
										@else
											Khác
										@endif
									</td>
								</tr>
								<tr>
									<td>Tình Trạng</td>
									<td>
										<?php
										if($value->TinhTrang ==0)
											echo 'Đang Xử Lý...';
										elseif($value->TinhTrang ==1){
											echo 'Đang Giao Hàng';
										}else{
											echo 'Đã Giao Hàng';
										} 
										?>
									</td>
								</tr>
								<tr>
									<td>Thành Tiền</td>
									<td>{{$value->ThanhTien.'đ'}}</td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</div>
	@endforeach
	<div class="row">
		<div class="col-lg-12 col-md-12"></div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header card-header-primary">
					<h4 class="card-title">Danh sách sản phẩm</h4>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-hover">
						<thead class="text-warning">
							<th width="20%">Mã</th>
							<th width="20%">Tên Sản Phẩm</th>
							<th width="20%">Số Lượng</th>
							<th width="20%">Giá</th>
							<th width="20%">Thành Tiền</th>
						</thead>
						<tbody>
							@foreach($order_details as $order_val)
							<tr>
								<td>{{$order_val->MSHH}}</td>
								<td>{{$order_val->TenHH}}</td>
								<td>{{$order_val->SoLuong}}</td>
								<td>{{$order_val->GiaDatHang}}</td>
								<td>{{$order_val->Gia * $order_val->SoLuong}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>  {{-- end card body --}}
			</div>
		</div>
	</div>
	@if(session('notice'))
	<p style="color: red">
		{{session('notice')}}
	</p>
	@endif
	<div class="row">
		<div class="col-lg-2 col-md-2">
			<form action="{{URL::to('/update_status')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" name="SoDonDH" value="{{$SoDonDH}}">
				<input type="hidden" name="TinhTrang" value="1">
				<input type="submit" name="Update" value="Xác Nhận" class="btn btn-success">
			</form>
		</div>
		<div class="col-lg-2 col-md-2">
			<a href="{{URL::to('/order_management')}}" class="btn btn-danger">Quay Lại</a>
		</div>
	</div>
</div>

@endsection