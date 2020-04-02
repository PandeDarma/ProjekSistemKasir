<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barang;
use App\Kategori;
use App\Lokasi;
use App\Stock;
use DB;

class BarangController extends Controller
{
    //
    public function index(Request $request)
    {
        // mengambil semua data dari model
        $stock = Stock::all();
        $lokasi = Lokasi::all();

        if (!$request->keyword) {
            $barang = Barang::paginate(4);
            return view('barang.index', compact(["barang", "stock", "lokasi"]));
        } else {
            // mencari data barang berdasarkan Key
            $barang = Barang::joinkategoriwithkey($request->keyword);
            return view('barang.index', compact(["barang", "stock", "lokasi"]));
        }
    }

    public function tambah(Request $request)
    {


        $kategori = Kategori::all();
        $lokasi = Lokasi::all();
        return view('barang.tambah', compact('kategori', 'lokasi'));
    }
    public function addBarang(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama Barang Harus diisi'
        ];
        $request->validate([
            'nama' => 'required',
            'barcode' => 'required',
            'kategori' => 'required',
            'gudang' => 'required',
            'showcase' => 'required',
            'harga' => 'required'
        ], $messages);
        $data = [
            'barcode' => $request->barcode,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori
        ];
        Barang::create($data);
        // mengambil data
        $lokasi = Lokasi::all();
        // menginput data stock berdasarkan lokasi
        foreach ($lokasi as $l) {
            $data2 = [
                "barcode" => $request->barcode,
                "lokasi_id" => $l->id,
                "stock" => $request->input($l->nama),
            ];
            Stock::create($data2);
        }

        return redirect('/barang')->with('flash', 'Data berhasil ditambah');
    }
    public function delete($id)
    {
        $barcode = Barang::find($id)->barcode;
        // menghapus berdasarkan barcode
        Stock::joinbarangdelete($barcode);
        $barang = Barang::destroy($id);
        return redirect('/barang')->with("flash", "Data Berhasil Di Hapus");
    }

    public function edit(Request $request, $id)
    {

        $barang = Barang::find($id);
        $stock = Stock::where('barcode', $barang->barcode)->get();
        $lokasi = Lokasi::all();
        $kategori = Kategori::all();

        return view('barang.edit', compact(["barang", "stock", "lokasi", "kategori"]));
    }

    public function editBarang($id, Request $request)
    {

        // validasi form
        $request->validate(
            [
                "nama" => 'required',
                "barcode" => 'required|numeric',
                "gudang" => 'numeric|nullable',
                "showcase" => 'numeric|nullable',
                "harga" => 'required|numeric'
            ]
        );
        // mengambil data
        $lokasi = Lokasi::all();
        $data1 = [
            "barcode" => $request->barcode,
            "nama" => $request->nama,
            "harga" => $request->harga,
            "kategori_id" => $request->kategori,
        ];

        // melakukan update
        Barang::where('id', $id)
            ->update($data1);
        // mengambil data stock gudang, yang nantinya jika stock showcase ditambah gudang akan berkurang
        $gudang = Stock::where('lokasi_id', 1)
            ->where('barcode', $request->barcode)->first()->stock;

        foreach ($lokasi as $l) {
            // melakukan perulangan dan jika showcase ditambah maka stock gudang berkurang
            $datalama =  Stock::where('lokasi_id', $l->id)
                ->where('barcode', $request->barcode)->get();
            foreach ($datalama as $lm) {
                if ($lm->lokasi_id == $l->id) {
                    if ($lm->lokasi_id == 2 && $l->id == 2) {
                        $stock = $gudang - $request->input($l->nama);
                        Stock::where('lokasi_id', 1)
                            ->where('barcode', $request->barcode)->update(['stock' => $stock]);
                    }
                    $stock = $lm->stock + $request->input($l->nama);
                }
            }
            Stock::where('lokasi_id', $l->id)
                ->where('barcode', $request->barcode)->update(['stock' => $stock]);
        }

        return redirect('/barang')->with('flash', "Data Berhasil Di Edit");
    }

    public function tambahkategori(Request $request)
    {
        // $email = $request->session()->all()['email'];
        // $user = User::where('email', $email)->first();
        // return view('barang.kategori', compact("user"));
        return view('barang.kategori');
    }

    public function addKategori(Request $request)
    {
        $request->validate([
            "nama" => "required|string"
        ]);

        Kategori::create($request->all());

        return redirect('/barang')->with('flash', "Kategori berhasil Ditambah");
    }
}
