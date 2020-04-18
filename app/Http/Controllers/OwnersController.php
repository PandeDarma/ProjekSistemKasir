<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Detailtransaksi;
use Illuminate\Support\Facades\Gate;



class OwnersController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            if (Gate::allows('owner')) {
                return $next($request);
            } else {
                return redirect('/kasir');
            }
        });
    }
    public function index(Request $request)
    {

        $detailtransaksi = Detailtransaksi::all();

        $transaksi = Transaksi::where('date', 'like', '%' . $request->keyword . '%')
            ->orWhere('total', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC')
            ->paginate(7)->appends(["keyword" => $request->keyword]);
        return view('owner.laporan', compact("transaksi", "detailtransaksi"));
    }

    public function show($id, Request $request)
    {

        $detail = Detailtransaksi::joinBarangGetwhereId($id);
        $transaksi = Transaksi::where("id", $id)->first()->total;
        return view("owner/detaillaporan", compact(["detail", "transaksi"]));
    }

    public function pendapatan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $listbulan = [
            ["no" => "01", "value" => "Januari"],
            ["no" => "02", "value" => "Februari"],
            ["no" => "03", "value" => "Maret"],
            ["no" => "04", "value" => "April"],
            ["no" => "05", "value" => "Mei"],
            ["no" => "06", "value" => "Juni"],
            ["no" => "07", "value" => "Juli"],
            ["no" => "08", "value" => "Agustus"],
            ["no" => "09", "value" => "September"],
            ["no" => "10", "value" => "Oktober"],
            ["no" => "11", "value" => "November"],
            ["no" => "12", "value" => "Desember"]
        ];
        if (!$bulan) {
            $transaksi = Transaksi::where('id', 0)->get();
            return view('owner/penghasilan', compact("transaksi", "listbulan"));
        } else {
            $transaksi = Transaksi::where('date', 'like', '%' . $tahun . '-' . $bulan . '%')->get();
            return view('owner/penghasilan', compact("transaksi",  "bulan", 'tahun', 'listbulan'));
        }
    }
}
