<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Carbon\Carbon;
use Session;
session_start();

class CartController extends Controller
{
    public function delete_cart($session_id){
    	$cart = Session::get('cart');
        if($cart==true){
            foreach ($cart as $key => $val) {
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);                    
                }
            }
            Session::put('cart',$cart);
            return Redirect::to('/cart_shopping');
        }
    }

    public function del_Cart($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach ($cart as $key => $val) {
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);                    
                }
            }
            Session::put('cart',$cart);
            echo json_encode(1);
        }
    }

    public function update_cart(Request $req){
        $data = $req->all();
        $qty_stk=0;
        
        $cart= Session::get('cart');
        if ($cart==true) {
            foreach ($data['quantity'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    if($val['session_id']== $key){
                        //Lấy mã số của sp
                        $MSHH=$cart[$session]['product_id'];
                        //Lấy số lượng tồn
                        $kq=DB::table('hanghoa')->where('MSHH',$MSHH)->select('SoLuongHang')->get();
                        foreach ($kq as $k => $val) {
                            $qty_stk=$val->SoLuongHang;
                        }

                        if ($qty <= $qty_stk) {
                            $cart[$session]['product_qty'] = $qty;
                        }else{
                            return Redirect::to('/cart_shopping')->with('notice','Số lượng tồn không đủ');
                        }
                    }
                }
            }
            Session::put('cart',$cart);
            return Redirect::to('/cart_shopping');
        }
    }

    //AJAX
    public function add_cart_ajax(Request $request){
        $data=$request->all();
        $notification=array();
        $notification['error']=0;
        $session_id=substr(md5(microtime()), rand(0,26),5);
        $cart=Session::get('cart');
        $qty_ton=0;
        //Lấy số lượng tồn 
        $kq=DB::table('hanghoa')->where('MSHH',$data['cart_product_id'])->select('SoLuongHang')->get();
        foreach ($kq as $k => $val) {
            $qty_ton=$val->SoLuongHang;
        }

        $ses_id=0;
        if($cart==true){
            $is_available = 0;
            //Kiểm tra sản phẩm mới thêm có trùng với sp có trong session cart
            foreach ($cart as $key => $val) {
                if($val['product_id'] == $data['cart_product_id']){
                    $is_available++;
                    $ses_id=$key;
                }
            }
            //Nếu không có trùng trong giỏ hàng thì tạo cart mới thêm vào
            if($is_available==0){
                //Nếu sp thêm vào giỏ hàng có sl nhỏ hơn sl tồn
                if($data['cart_product_qty']<=$qty_ton){
                    $cart[] = array(
                        'session_id'   => $session_id,
                        'product_name' => $data['cart_product_name'],
                        'product_id'   => $data['cart_product_id'],
                        'product_image'=> $data['cart_product_image'],
                        'product_qty'  => $data['cart_product_qty'],
                        'product_discount'=> $data['cart_product_discount'],
                        'product_price'=> $data['cart_product_price']
                    );
                    Session::put('cart',$cart);
                }else{
                    $notification['error']=1;
                }
            }else{
                //Nếu có sp trùng thì cộng dồn số lượng
                $qty_new=$cart[$ses_id]['product_qty']+ $data['cart_product_qty'];
                if ( $qty_new <= $qty_ton ) {
                    $cart[$ses_id]['product_qty']=$cart[$ses_id]['product_qty']+ $data['cart_product_qty'];
                    Session::put('cart',$cart);
                }else{
                    $notification['error']=1;
                }
            }
        }else{
            //Nếu chưa có cart thì tạo mới
            if($data['cart_product_qty']<=$qty_ton){
                $cart[] = array(
                    'session_id'   => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id'   => $data['cart_product_id'],
                    'product_image'=> $data['cart_product_image'],
                    'product_qty'  => $data['cart_product_qty'],
                    'product_discount'=> $data['cart_product_discount'],
                    'product_price'=> $data['cart_product_price']
                );
                Session::put('cart',$cart);
            }else{
                $notification['error']=1;
            }
        }
        
        Session::save();
        $notification['count']= count($cart);
        echo json_encode($notification);

    }
    public function cart_shopping(Request $re){
        //Seo
        $meta_desc="Giỏ hàng của bạn";
        $meta_keywords="Shopping Cart";
        $meta_tittle="QPharmacy";
        $url=$re->url();
        // end seo

        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
        $all_cate = DB::table('danhmuc')->get();
        
        return view('pages.cart.cart_shopping')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)->with('cate',$all_cate);
    }

    public function show_mini_cart(){
        $cart=Session::get('cart');
        $total=0;
        $dis_total = 0;
        $output='';
        if ($cart) {
            $output.='<div class="minicart-content-box">
                        <div class="minicart-item-wrapper" >
                            <ul id="minicart_cnt">';
            foreach ($cart as $key => $value) {
                $total=$total+$value['product_price']*$value['product_qty']*(1-$value['product_discount']);
                $dis_total =$dis_total+$value['product_price']*$value['product_qty']*$value['product_discount'];
                $link_product='/product_details/'.$value['product_id'];
                $link_image='/public/upload/'.$value['product_image'];
                $link_delete_cart= '/delete_cart/'.$value['session_id'];

                $output.='<li class="minicart-item">
                <div class="minicart-thumb">
                <a href="'.url($link_product).'">
                <img src="'.url($link_image).' " alt="product">
                </a>
                </div>
                <div class="minicart-content">
                <h3 class="product-name">
                <a href="'.url($link_product).'">'.$value['product_name'].'</a>
                </h3>
                <p>
                <span class="cart-quantity">'.$value['product_qty'].'<strong>&times;</strong></span>
                <span class="cart-price"> '.
                number_format($value['product_price']*$value['product_qty']*(1-$value['product_discount']) , 0, ',', ' ').'đ'.'
                </span>
                </p>
                </div>
                </li>';
            }
            $output.='</ul>
                        </div>
                        <div class="minicart-pricing-box">
                        <ul>
                        <li>
                        <span>Tổng Tiền Đã Giảm</span>
                        <span><strong>'.number_format($dis_total , 0, ',', ' ').'đ'.'</strong></span>
                        </li>
                        <li class="total">
                        <span>Thành Tiền</span>
                        <span><strong>'.number_format($total , 0, ',', ' ').'đ'.'</strong></span>
                        </li>
                        </ul>
                        </div>
                        <div class="minicart-button">
                        <a href="'.url('/cart_shopping').'"><i class="fa fa-shopping-cart"></i> Xem Giỏ Hàng</a>
                        <a href="'.url('/check_out').' "><i class="fa fa-share"></i> Thanh Toán</a>
                        </div>';
        }else{
            $output.='<li class="minicart-item">
            <p>Không có sản phẩm nào trong giỏ.<br><a href="'.url('/trang_chu').'">Mời bạn mua hàng</a></p>
            </li>';
        }

        echo $output;
    }
}
