<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Lokasi;
use App\Barang;

class TransaksiController extends Controller
{
    //

    public function stock(Request $request)
    {

        $stock = Stock::all();
        $lokasi = Lokasi::all();
        $barang = Barang::all();

        if (!$request->keyword) {
            // jika tidak ada keyword yang diinput menampilkan semua data dan di paginate
            $barang = Barang::paginate(10);
            return view('kasir.stock', compact(["barang", "stock", "lokasi"]));
        } else {
            // mengambil data sesuai keyword
            $barang = Barang::joinkategoriwithkey($request->keyword);
            return view('kasir.stock', compact(["barang", "stock", "lokasi"]));
        }
    }
}
