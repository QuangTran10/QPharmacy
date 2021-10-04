<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    const CREATED_AT = 'TG_Tao';
    const UPDATED_AT = 'TG_CapNhat';

    public $timestamps = true;

    protected $fillable = ['TenNSX', 'TinhTrang'];

    protected $primaryKey='MaNSX';

    protected $table='nhasanxuat';

    // public function Product()
    // {
    // 	return $this->belongsTo('App\Models\Product', 'foreign_key', 'MaNSX');
    // }
}
