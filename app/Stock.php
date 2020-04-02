<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = "stock";
    protected $fillable = ["barcode", "lokasi_id", "stock"];
    public $timestamps = false;

    public static function joinbarangdelete($barcode)
    {
        return DB::table('stock')->join('barang', 'barang.barcode', '=', 'stock.barcode')->where('barang.barcode', $barcode)->delete();
    }
}
