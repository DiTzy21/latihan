<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class adminController extends Controller
{
     public function index(Request $reqs) {
        $barang = DB::select('SELECT * FROM barangs');
        return view('admin.admin',['barang' => $barang]);
    }
    
    // for add the product

    public function edit($id, Request $reqs) {
        $barang = DB::table('barangs')->where('id', $id)->first();
        return view('admin.edit', ['barang' => $barang]);
    }


 public function update(Request $request) {
    $id = $request->input('id');
    $nama_barang = $request->input('nama_barang');
    $gambar = $request->input('gambar');
    $harga = $request->input('harga');
    $stok = $request->input('stok');
    $keterangan = $request->input('keterangan');

    //debug

    
    DB::update('UPDATE barangs SET 
         
        nama_barang = ?, 
        gambar = ?,
        harga = ?, 
        stok = ?,
        keterangan = ?, 
        created_at = NOW()
    WHERE id = ?', 
    [ $nama_barang, $gambar, $harga, $stok, $keterangan, $id]);
   
  return redirect('/admin/product')->with('success', 'Product Edit Successful ! ');;
}

public function delete($id) {
    DB::table('barangs')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Product deleted successfully.');
    }

public function add($id, Request $reqs) {
    $product = DB::table('barangs')->where('id', $id)->first();
    return view('admin.add', ['id' => $id])->with('success', 'Product Added successfully.');
}

 public function store(Request $request)
    {
        $nama_barang = $request->input('nama_barang');
        $gambar = $request->input('gambar');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        $keterangan = $request->input('keterangan');
        
        Log::debug($nama_barang);
        DB::table('barangs')->insert([
            'nama_barang' => $nama_barang,
            'gambar' => $gambar,
            'harga' => $harga,
            'stok' => $stok,
            'keterangan' => $keterangan
        ]);        
        return redirect('/admin/product');
    }

    

}