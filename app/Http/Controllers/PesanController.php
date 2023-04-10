<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
        $barang =   Barang::where('id', $id)->first();

        return view('pesan.index', compact('barang'));
    }

    public function pesan(Request $request, $id)
    {
        $barang =   Barang::where('id', $id)->first();
        $tanggal =  Carbon::now();

        //validasi apakah melebihi stok

        if ($request->jumlah_pesan > $barang->stok) {
            return redirect('pesan/' . $id);
        }

        //cek validasi

        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //simpan ke database pesanan
        if (empty($cek_pesanan)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }
        //simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if (empty($cek_pesanan_detail)) {


            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->save();
        } else {
            $pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $barang->harga * $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }
        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $barang->harga * $request->jumlah_pesan;
        $pesanan->update();


        
        return redirect('check-out')->with('success', 'Successfully Added to Cart 🛒🛒');;
    }
    public function check_out()
{
    $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
    $pesanan_detail = [];

    if(!empty($pesanan))
    {
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
    }

    return view('pesan.check_out', compact('pesanan', 'pesanan_detail'));
}

    // public function delete($id)
    // {
    //     // $pesanan_detail = PesananDetail::where('id', $id)->first();
    //     // $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
    //     // $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
    //     // $pesanan->update();

    //     // return redirect("check-out");
        
    // }

    public function delete($id)
    {
    $pesanan_detail = PesananDetail::where('id', $id)->first();
    $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();

    $pesanan->jumlah_harga -= $pesanan_detail->jumlah_harga;
    $pesanan->update();

    $pesanan_detail->delete();

    return redirect("check-out")->with('success', 'Product Delete Successful ! ');
    }

    public function konfirmasi()
    {
        // $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // $pesanan->status = 0;
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->status = 1; // or whatever value indicates a submitted order
        // $pesanan->update();

        $pesanan->update();
        $ids = DB::select("SELECT * FROM pesanan_details WHERE pesanan_id = ?", [$pesanan->id]);
        $data = $this->getIds($ids);
        // Alert::question('Question Title', 'Question Message');
        // return alert()->question('Apakah kamu puas ? ','lorem,lorem');
        return response()->json(["ids" => $data]);
       
    }

    public function getIds($ids) {
        $data = [];
        foreach($ids as $id) {
            $data[] = $id->barang_id;
        }
        return $data;
    }
}
