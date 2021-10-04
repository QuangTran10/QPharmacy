<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	const CREATED_AT = 'TG_Tao';
    const UPDATED_AT = 'TG_CapNhat';

    public $timestamps = true;

    protected $fillable = ['TenLoaiHang', 'TinhTrang'];

    protected $primaryKey='MaLoaiHang';

    protected $table='loaihanghoa';

    // public function Product()
    // {
    // 	return $this->belongsTo('App\Models\Product', 'foreign_key', 'MaLoaiHang');
    // }

}
