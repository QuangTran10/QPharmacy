<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>In đơn hàng</title>

<style type="text/css">
    *{
      font-family: DejaVu Sans, sans-serif;
    }
    table{
      font-size: x-small;
    }
    tfoot tr td{
      font-size: x-small;
    }
    .tbl1{
      width: 40%;
      float: right;
    }
    .tbl2{
      width: 60%;
    }
</style>

</head>
<body>
  @php
    $image = $URL;
    $imageData = base64_encode(file_get_contents($image));
    $src = 'data:'.mime_content_type($image).';base64,'.$imageData;
  @endphp

  <table width="100%">
    <tr>
      <td valign="top" align="center"><img src="{{$src}}" style="width: 200px"></td>
      <td align="left">
        <div>
          @foreach($contact as $k)
          <p><b>Địa Chỉ: </b>{{$k->DiaChi}} </p>
          <p><b>Số Điện Thoại: </b>{{$k->SoDienThoai}}</p>
          <p><b>Email: </b>{{$k->Email}}</p>
          @endforeach   
        </div>
      </td>
    </tr>
  </table>

  <br><br>

  @foreach($order as $value)
  @php
    $tong = $value->ThanhTien;
  @endphp
  <div class="tbl1">
    <table>
      <tbody>
        <tr>
          <td colspan="2"><h4>THÔNG TIN CÁ NHÂN</h4></td>
        </tr>
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
  <div class="tbl2">
    <table>
      <tbody>
        <tr>
          <td colspan="2"><h4>THÔNG TIN ĐƠN HÀNG</h4></td>
        </tr>
        <tr>
          <td width="40%">Họ Và Tên</td>
          <td width="60%">{{$value->HoTen}}</td>
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
      </tbody>
    </table>
  </div>
  @endforeach

  <br><br>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Số Lượng </th>
        <th>Giảm Giá</th>
        <th>Thành Tiền</th>
      </tr>
    </thead>
    <tbody>
      @php
        $dis_total=0;
      @endphp
      @foreach($order_details as $order)
      @php
      $dis_total=$dis_total+$order->SoLuong*$order->GiaDatHang*$order->GiamGia;
      @endphp
      <tr>
        <th style="text-align: left;">{{$order->TenHH}}</th>
        <td align="center">{{number_format($order->GiaDatHang , 0, ',', ' ').'đ';}}</td>
        <td align="center">{{$order->SoLuong}}</td>
        <td align="right">{{$order->GiamGia*100}}%</td>
        <td align="right">{{number_format($order->ThanhTien , 0, ',', ' ').'đ';}}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right"><b>Phí Vận Chuyển</b></td>
            <td align="right">
              @if($tong >1000000)
                Miễn phí giao hàng
              @else
                {{number_format(30000 , 0, ',', ' ').'đ';}}
              @endif
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right"><b>Tổng Giảm</b></td>
            <td align="right">{{number_format($dis_total , 0, ',', ' ').'đ';}}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right"><b>Thành Tiền</b></td>
            <td align="right">{{number_format($tong , 0, ',', ' ').'đ';}}</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>