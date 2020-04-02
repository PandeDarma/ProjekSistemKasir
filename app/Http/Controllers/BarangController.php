<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barang;
use App\Lokasi;
use App\Stock;
use DB;

class BarangController extends Controller
{
    //
    public function index()
    {

        $barang = Barang::paginate(4);
        $stock = Stock::all();
        $lokasi = Lokasi::all();

        return view('barang.index', compact('barang', 'stock', 'lokasi'));
    }
}
