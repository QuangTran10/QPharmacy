<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File; 
use Session;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add(){
        $this->AuthLogin();
    	$all_category = DB::table('loaihanghoa')->get();
        $all_producer = DB::table('nhasanxuat')->get();
    	return view('admin.Product.add_product')->with('category',$all_category)->with('producer',$all_producer);
    }

    public function product_management(){
        $this->AuthLogin();
        $all_product = DB::table('hanghoa')
        ->join('loaihanghoa', 'hanghoa.MaLoaiHang', '=', 'loaihanghoa.MaLoaiHang')
        ->join('nhasanxuat', 'hanghoa.MaNSX', '=', 'nhasanxuat.MaNSX')
        ->simplePaginate(5);
        Session::put('page',2);
        $manage_product = view('admin.Product.product_management')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.Product.product_management',$manage_product);
    }

    public function save_product(Request $re){
        $this->AuthLogin();
    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$data = array();

    	$data['TenHH'] = $re->TenHangHoa;
    	$data['Gia'] = $re->Gia;
    	$data['SoLuongHang'] = $re->SoLuong;
    	$data['MaLoaiHang'] = $re->LoaiHang;
        $data['MaNSX'] = $re->NSX;
    	$data['MoTa'] = $re->MoTa;
        $data['GiamGia']=0;
    	$data['TrangThai'] = $re->TrangThai;
    	$data['TG_Tao'] = $now;
    	$data['TG_CapNhat'] = $now;
    	
        //upload ảnh
        $get_image = $re->file('hinhanh1');
        
        if($get_image){
            $get_name = $get_image->getClientOriginalName();
            $name = current(explode('.', $get_name));
            $new_image = $name.time() .'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $data['hinhanh1']=$new_image;
            DB::table('hanghoa')->insert($data);
            return Redirect::to('product_management');
        }
        Session::put('message','Thêm Thất bại');
        return Redirect::to('add_product');
    }

    public function update_product($id){
        $this->AuthLogin();
        $all_product = DB::table('hanghoa')->where('MSHH',$id)->get();
        $all_category = DB::table('loaihanghoa')->get();
        $all_producer = DB::table('nhasanxuat')->get();
        return view('admin.Product.update_product')->with('all_product',$all_product)->with('category',$all_category)->with('producer',$all_producer);
    }

    //Hàm cập nhật sản phẩm
    public function edit_product(Request $re,$id){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $data['TenHH'] = $re->TenHangHoa;
        $data['Gia'] = $re->Gia;
        $data['SoLuongHang'] = $re->SoLuong;
        $data['MaLoaiHang'] = $re->LoaiHang;
        $data['MaNSX'] = $re->NSX;
        $data['MoTa'] = $re->MoTa;
        $data['GiamGia']=$re->GiamGia;
        $data['TrangThai'] = $re->TrangThai;
        $data['TG_Tao']= $re->TG_Tao;
        $data['TG_CapNhat'] = $now;

        $get_image = $re->file('hinhanh1');
        if($get_image){
            $get_name = $get_image->getClientOriginalName();
            $name = current(explode('.', $get_name));
            $new_image = $name.time() .'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload',$new_image);
            $data['hinhanh1']=$new_image;
            DB::table('hanghoa')->where('MSHH',$id)->update($data);
            return Redirect::to('product_management');
        }

        DB::table('hanghoa')->where('MSHH',$id)->update($data);
        return Redirect::to('product_management');
    }

    //Chuyển trang xoá SP
    public function delete($id,$hinhanh){
        $this->AuthLogin();
        DB::table('hanghoa')->where('MSHH',$id)->update(['TrangThai'=>0]);
        return Redirect::to('product_management');
    }

    //Các sp bán chạy
    public function best_sell(Request $re){
        $bestsell = DB::table('chitietdathang')
        ->select(DB::raw('COUNT(MSHH) as sl', 'MSHH'),'MSHH')->groupBy('MSHH')
        ->orderBy('sl','Desc')
        ->limit(10)->get();

        $labels=array();
        $series=array();
        foreach ($bestsell as $key => $value) {
            $labels[]=$value->MSHH;
            $series[]=$value->sl;
        }
        $chart_data = array(
            'labels' => $labels,
            'series' => $series
        );

       echo $data = json_encode($chart_data);
    }

    //END ADMIN

    public function show_all_product(Request $re){
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();

        $product_all =DB::table('hanghoa')->where('TrangThai',1)->get();

        if (isset($_GET['sort_by'])) {

            $sort_by= $_GET['sort_by'];

            if($sort_by=='az'){

                $product_all =DB::table('hanghoa')->where('TrangThai',1)->orderBy('TenHH','ASC')->get();

            }elseif ($sort_by=='za') {

                $product_all =DB::table('hanghoa')->where('TrangThai',1)->orderBy('TenHH','DESC')->get();

            }elseif ($sort_by=='increase') {

                $product_all =DB::table('hanghoa')->where('TrangThai',1)->orderBy('Gia','ASC')->get();

            }elseif ($sort_by=='decrease') {

                $product_all =DB::table('hanghoa')->where('TrangThai',1)->orderBy('Gia','DESC')->get();
                
            }
        }else{
            $product_all =DB::table('hanghoa')->where('TrangThai',1)->orderBy('MSHH','ASC')->get();
        }

        //Seo
        $meta_desc="Tất cả sản phẩm";
        $meta_keywords="All Product";
        $meta_tittle="QPharmacy";
        $url=$re->url();
        // end seo

        $count_product_all=DB::table('hanghoa')->where('TrangThai',1)->get()->count();
        return view('pages.category.show_category')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('product',$product_all)->with('soluong',$count_product_all)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url);
    }

    public function product_detail($id,  Request $re){
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
        $product_detail = DB::table('hanghoa')->where('MSHH',$id)->get();
        foreach ($product_detail as $key => $value) {
            $MaLoaiHang=$value->MaLoaiHang;
            //Seo
            $meta_desc=$value->TenHH;
            $meta_keywords="Product Detail - ". $id;
            $meta_tittle=$value->TenHH;
            $url=$re->url();
            // end seo
        }
        $reviews=DB::table('binhluan')->where('MSHH',$id)->get();
        $count=0;
        $total=0;
        foreach ($reviews as $k => $val) {
            $count++;
            $total=$total+$val->DanhGia;
        }
        if ($count==0) {
            $total=0;
        }else{
            $total=round($total/$count);
        }
        
        $related_product = DB::table('hanghoa')->where('MaLoaiHang',$MaLoaiHang)->whereNotIn('MSHH',[$id])->get();
        return view('pages.product.product_details')
        ->with('category',$all_category)
        ->with('producer',$all_producer)
        ->with('product_detail',$product_detail)
        ->with('related_product',$related_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_tittle',$meta_tittle)->with('url',$url)
        ->with('count_reviews',$count)->with('Total',$total);
    }

    //quick_view
    public function quick_view(Request $re){
        $id_product= $re->id_product;
        $output= array();
        $product_detail = DB::table('hanghoa')->where('MSHH',$id_product)->get();

        $reviews=DB::table('binhluan')->where('MSHH',$id_product)->get();
        $count=0;
        $total=0;
        foreach ($reviews as $k => $val) {
            $count++;
            $total=$total+$val->DanhGia;
        }
        $output['rating']='';
        if ($count==0) {
            $total=0;
        }else{
            $total=round($total/$count);
            for ($i=1; $i <=$total ; $i++) { 
                $output['rating'].='<span><i class="lnr lnr-star"></i></span>';
            }
        }

        foreach ($product_detail as $key => $value) {
            $output['MSHH']=$value->MSHH;
            $output['TenHH']=$value->TenHH;
            $output['Gia']=number_format($value->Gia, 0, ',', ' ')."đ";
            $output['SoLuongHang']=$value->SoLuongHang;
            $output['MoTa']=$value->MoTa;
            $url = '/public/upload/'.$value->hinhanh1;
            $output['hinhanh1']='<img src="'.url($url).' " alt="product-details" />';
            $output['quickview_value']='
                <input type="hidden" name="Id_'.$value->MSHH.'" value="'.$value->MSHH.'" class="cart_product_id_'.$value->MSHH.'">
                <input type="hidden" name="Name" value="'.$value->TenHH.'" class="cart_product_name_'.$value->MSHH.'">
                <input type="hidden" name="Image" value="'.$value->hinhanh1.'" class="cart_product_image_'.$value->MSHH.'">
                <input type="hidden" name="Price" value="'.$value->Gia.'" class="cart_product_price_'.$value->MSHH.'">
                <input type="hidden" name="Discount" value="'.$value->GiamGia.'" class="cart_product_discount_'.$value->MSHH.'">
                <input type="hidden" name="SoLuong" value="1" class="cart_product_qty_'.$value->MSHH.'">';
            $output['button_quickview']='
            <a class="btn btn-cart2" href="#">Thêm Vào Giỏ Hàng</a>';   
        }
        $output['review']='<span>'.$count.' Đánh Giá</span>';
        echo json_encode($output);
    }

    //Yêu thích
    public function favourite_product(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data=array();
        $notification=array();

        $MSKH=Session::get('user_id');
        if ($MSKH) {
            $MSHH = $request->id_product;
            $data['MSKH']=$MSKH;
            $data['MSHH']=$MSHH;
            $data['TG_Tao']=$now;

            $re = DB::table('yeuthich')->where('MSKH',$MSKH)->where('MSHH',$MSHH)->select('Ma')->get();
            $Ma=null;
            foreach ($re as $key => $value) {
                $Ma = $value->Ma;
            }
            if($Ma==null){
                $result = DB::table('yeuthich')->insert($data);
                $notification['status']=1;
                // echo json_encode(1); //Nếu sản phẩm chưa có trong DB -> thêm vào
                
            }else{
                $notification['status']=2;
                // echo json_encode(2); //Nếu đã có trong DB yêu thích
            } 
        }else{
            $notification['status']=3;
            // echo json_encode(3); //Nếu chưa đăng nhập
        }
        $count= DB::table('yeuthich')->where('MSKH',$MSKH)->get()->count();
        $notification['count']=$count;
        echo json_encode($notification);
    }

    //Chuyển trang sp yêu thích
    public function wish_list(Request $re){
        $all_category = DB::table('loaihanghoa')->where('TinhTrang',1)->get();
        $all_producer = DB::table('nhasanxuat')->where('TinhTrang',1)->get();
        //Seo
        $meta_desc="";
        $meta_keywords="Trang yêu thích";
        $meta_tittle="Wish List";
        $url=$re->url();
        // end seo
        $all_wish_list=array();
        $MSKH=Session::get('user_id');
        if ($MSKH) {
            $all_wish_list= DB::table('yeuthich')->where('MSKH',$MSKH)
            ->join('hanghoa', 'hanghoa.MSHH', '=', 'yeuthich.MSHH')->get();
        }
        
        return view('pages.product.wishlist')
        ->with('category',$all_category)->with('producer',$all_producer)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)
        ->with('meta_tittle',$meta_tittle)->with('url',$url)->with('all_wish_list',$all_wish_list);
    }

    public function delete_wishlist(Request $re){
        $Ma= $re->Ma;
        DB::table('yeuthich')->where('Ma',$Ma)->delete();
    }

    public function count_wishlist(){
        $MSKH=Session::get('user_id');
        if($MSKH!=null){
            $count_wish= DB::table('yeuthich')->where('MSKH',$MSKH)->get()->count();
        }else{
            $count_wish=0;
        }
        echo $count_wish;
    }
}
