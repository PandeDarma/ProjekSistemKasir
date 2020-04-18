<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Lokasi;
use App\Barang;
use App\Kategori;
use App\Transaksi;
use App\Detailtransaksi;
use App\User;

class TransaksiController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $latest = Transaksi::latest('date')->first();

        return view('kasir.kasir', compact("latest"));
    }


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
    public function action(Request $request)
    {
        // menampilkan harga dan nama barang
        if ($request->ajax()) {
            $keyword = $request->get('keyword');
            if ($keyword != '') {
                $isi = Barang::where('barcode',  $keyword)->first()->nama;
                $harga = Barang::where('barcode', $keyword)->first()->harga;
            }
            $data = [
                'namabarang' => $isi,
                'harga' => $harga
            ];
            // membuat array menjadi json
            echo json_encode($data);
        }
    }

    public function detail(Request $request)
    {
        if ($request->ajax()) {
            $namabarang = $request->namabarang;
            $data1 = [
                "transaksi_id" => $request->transId,
                "barcode" => $request->barcode,
                "kuantiti" => $request->kuantiti,
                "harga" => $request->harga
            ];

            // mengurangi kuantiti yang tedapat pada stock
            // menggunakan advance where
            $showcase = Stock::where('barcode', $data1['barcode'])->where(function ($e) {
                $e->where('lokasi_id', 2);
            })->first()->stock;
            $showcase = $showcase - $data1['kuantiti'];
            // menggunakan eloquent where
            Stock::where('barcode', $data1['barcode'])->where('lokasi_id', 2)
                ->update(['stock' => $showcase]);

            // pernyataan dibawah bisa diatasi dengan membuat timestamps menjadi false di model yang bermasalah
            // menambahkan data ke database menggunakan static method yang didalamnya query builder dikarenakan terdapat kesalahan jika menggunakan eloquent
            Detailtransaksi::inputData($data1);
            $output = '';
            // tampilan jika button simpan yang pertama atau di atas di klik pada transaksi
            $output .= '
            <tr class ="rowo ' . $data1['barcode'] .   '" >
                <td scope="row">' . $namabarang . '</td>
                <td scope="row" class="kuantiti ' . $data1['barcode'] . '">' . $data1['kuantiti'] . '</td>
                <td scope="row" class="harga ' . $data1['barcode'] . '">' . $data1['harga'] . '</td>
                <td scope="row">
                <button class="badge badge-danger batal2"  value=' . $data1['barcode'] . '>Batal</button>
                <button class="badge badge-success tambah"  value=' . $data1['barcode'] . '>+</button>
                <button class="badge badge-warning kurang"  value=' . $data1['barcode'] . '>-</button>
                </td>
            </tr>
            ';

            $data = [
                "output" => $output
            ];

            echo json_encode($data);
        }
    }

    public function hapus(Request $request)
    {
        if ($request->ajax()) {
            $barcode = $request->barcode;
            $id = $request->transId;
            $total = $request->total;
            // mengambil data berdasarkan barcode dan transaksi id
            $dualwhere = Detailtransaksi::getoneDualWhere('barcode', $barcode, 'transaksi_id', $id);

            $barang = $dualwhere->harga;
            $kuantiti = $dualwhere->kuantiti;

            // menambah stock
            $showcase = Stock::where('barcode', $barcode)->where('lokasi_id', 2)->first()->stock;
            $showcase = $showcase + $kuantiti;

            Stock::where('barcode', $barcode)->where('lokasi_id', 2)->update(['stock' => $showcase]);

            $total2 = $barang * $kuantiti;

            $harga = $total - $total2;


            // DB::table('detailtransaksi')->where('barcode', $barcode)
            //     ->where(function ($e) use ($id) {
            //         $e->where("transaksi_id", $id);
            //     })
            //     ->delete();
            Detailtransaksi::where('barcode', $barcode)->where('transaksi_id', $id)->delete();

            $data = [
                "bar" => $barcode,
                "harga" => $harga
            ];

            echo json_encode($data);
        }
    }
    // menambahkan Transaksi secara keseluruhan
    public function tambah(Request $request)
    {

        if ($request->ajax()) {


            $nama_kasir = $request->nama;
            $total = $request->harga;

            Transaksi::create([
                'nama_kasir' => $nama_kasir,
                'total' => $total
            ]);
        }
    }

    public function batal(Request $request)
    {

        if ($request->ajax()) {
            $nota = $request->nota;
            // mengambil semua data yang memiliki id Transaksi this
            $data = Detailtransaksi::where('transaksi_id', $nota)->get();

            foreach ($data as $d) {
                $kuantiti = $d->kuantiti;
                $barcode = $d->barcode;

                // update stock pada showcase
                $showcase = Stock::where('barcode', $barcode)->where('lokasi_id', 2)->first()->stock;

                $showcase = $showcase + $kuantiti;

                Stock::where('barcode', $barcode)->where('lokasi_id', 2)->update(['stock' => $showcase]);
            }

            Detailtransaksi::where('transaksi_id', $nota)->delete();
        }
    }

    public function tambahsatu(Request $request)
    {
        if ($request->ajax()) {
            $barcode = $request->barcode;
            $nota = $request->nota;

            $showcase = Stock::where('barcode', $barcode)->where('lokasi_id', 2)->first()->stock;

            $showcase = $showcase - 1;

            $showcase = Stock::where('barcode', $barcode)->where('lokasi_id', 2)->update(['stock' => $showcase]);

            // perbandingan menggunakan query builder dengan eloquent laravel
            // ini query builder:-----------------------------------------------------------------------------
            // $kuantiti =  DB::table('detailtransaksi')->where('transaksi_id', $nota)
            //     ->where(function ($e) use ($barcode) {
            //         $e->where('barcode', $barcode);
            //     })->first()->kuantiti;
            // $kuantiti = $kuantiti + 1;
            // DB::table('detailtransaksi')->where('transaksi_id', $nota)
            //     ->where(function ($e) use ($barcode) {
            //         $e->where('barcode', $barcode);
            //     })->update(['kuantiti' => $kuantiti]);

            // INI eloquent laravel ---------------------------------------------------------------------
            $kuantiti = Detailtransaksi::where('transaksi_id', $nota)->where('barcode', $barcode)->first()->kuantiti;
            $kuantiti = $kuantiti + 1;
            Detailtransaksi::where('transaksi_id', $nota)->where('barcode', $barcode)->update(['kuantiti' => $kuantiti]);
        }
    }
    public function kurangsatu(Request $request)
    {
        if ($request->ajax()) {
            $barcode = $request->barcode;
            $nota = $request->nota;


            $showcase = Stock::where('barcode', $barcode)->where(function ($e) {
                $e->where('lokasi_id', 2);
            })->first()->stock;

            $showcase = $showcase + 1;

            $showcase = Stock::where('barcode', $barcode)->where(function ($e) {
                $e->where('lokasi_id', 2);
            })->update(['stock' => $showcase]);

            $kuantiti = Detailtransaksi::where('transaksi_id', $nota)->where('barcode', $barcode)->first()->kuantiti;
            $kuantiti = $kuantiti - 1;
            Detailtransaksi::where('transaksi_id', $nota)->where('barcode', $barcode)->update(['kuantiti' => $kuantiti]);
        }
    }
}
