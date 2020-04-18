<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Detailtransaksi extends Model
{
    //

    protected $table = "detailtransaksi";
    protected $fillable = ['transaksi_id', 'barcode', 'kuantiti', 'harga'];
    public $timestamps = false;

    public static function joinBarangGetwhereId($id)
    {
        return DB::table('detailtransaksi')->join("barang", "barang.barcode", '=', 'detailtransaksi.barcode')
            ->where("transaksi_id", $id)->get();
    }

    // menginput data yang sudah disusun terlebih dahulu
    public static function inputData($data)
    {
        DB::table('detailtransaksi')->insert($data);
    }

    public static function getoneDualWhere($field1, $value1, $field2, $value2)
    {
        return DB::table('detailtransaksi')->where($field1, $value1)
            ->where(function ($e) use ($value2, $field2) {
                $e->where($field2, $value2);
            })->first();
    }
}
