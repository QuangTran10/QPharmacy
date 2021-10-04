<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const CREATED_AT = 'TG_Tao';
    const UPDATED_AT = 'TG_CapNhat';

    public $timestamps = true;

    protected $fillable = ['TenHH', 'Gia', 'SoLuongHang', 'MaLoaiHang', 'MaNSX', 'MoTa', 'hinhanh1', 'TrangThai'];

    protected $primaryKey='MSHH';

    protected $table='hanghoa';

    // public function Category()
    // {
    // 	return $this->hasOne('App\Models\Category','foreign_key', 'MaLoaiHang');
    // }

    // public function Producer()
    // {
    // 	return $this->hasOne('App\Models\Producer','foreign_key', 'MaNSX');
    // }
}
