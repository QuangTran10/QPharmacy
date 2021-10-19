<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>In đơn hàng</title>

<style type="text/css">
    * {
        font-family: DejaVu Sans, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
      <td valign="top"></td>
      <td align="left">
        <h3>QPharmacy</h3>
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
  <div class="tbl1">
    
  </div>
  <div class="tbl2">
    
  </div>
    <table>
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
      @foreach($order_details as $order)
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
            <td align="right">Phí Vận Chuyển</td>
            <td align="right"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Tổng Giảm</td>
            <td align="right"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Thành Tiền</td>
            <td align="right"></td>
        </tr>
    </tfoot>
  </table>

</body>
</html>