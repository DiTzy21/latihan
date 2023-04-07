<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class adminController extends Controller
{
     public function index(Request $reqs) {
        $product = DB::select('SELECT * FROM barangs');
        return view('admin.productdb',['product' => $product]);
    }
    
    // for add the product

    public function edit($product_id, Request $reqs) {
        $product = DB::table('barangs')->where('id', $product_id)->first();
        return view('admin.productedit', ['product' => $product]);
    }


 public function update(Request $request) {
    $product_id = $request->input('product_id');
    $title = $request->input('title');
    $image = $request->input('image');
    $price = $request->input('price');
    $design_id = $request->input('design_id');
    $stock = $request->input('stock');
    $description = $request->input('description');

    DB::update('UPDATE product SET 
        product_id = ?, 
        title = ?, 
        image = ?,
        price = ?, 
        design_id = ?,
        stock = ?,
        description = ?, 
        created_at = NOW()
    WHERE product_id = ?', 
    [$product_id, $title, $image, $price, $design_id, $stock, $description, $product_id]);
   
  return redirect('/admin/product');
}

public function delete($product_id) {
    DB::table('product')->where('product_id', $product_id)->delete();
    return redirect()->back()->with('success', 'Product deleted successfully.');
    }

public function add($product_id, Request $reqs) {
    $product = DB::table('product')->where('product_id', $product_id)->first();
    return view('admin.productadd', ['product' => $product]);
}

 public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $title = $request->input('title');
        $image = $request->input('image');
        $price = $request->input('price');
        $design_id = $request->input('design_id');
        $stock = $request->input('stock');
        $description = $request->input('description');
        
        DB::table('product')->insert([
            'product_id' => $product_id,
            'title' => $title,
            'image' => $image,
            'price' => $price,
            'design_id' => $design_id,
            'stock' => $stock,
            'description' => $description
        ]);        
        return redirect('/admin/product');
    }

    

}