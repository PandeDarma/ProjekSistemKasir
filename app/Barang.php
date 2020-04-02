<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = "barang";
    protected $fillable = ['barcode', 'nama', 'harga', 'kategori_id'];
    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    // mencari data barang berdasarkan key
    public static function joinkategoriwithkey($key)
    {
        return DB::table('barang')->join('kategori', 'kategori.id', '=', 'barang.kategori_id')
            ->select('kategori.nama as kategorinama', 'barang.id', 'barang.barcode', 'barang.nama', 'barang.harga')
            ->where('barang.nama', 'like', '%' . $key . '%')
            ->orWhere('barang.harga', 'like', '%' . $key . '%')
            ->orWhere('kategori.nama', 'like', '%' . $key . '%')
            ->paginate(4)->appends(['keyword' => $key]);
    }
}
