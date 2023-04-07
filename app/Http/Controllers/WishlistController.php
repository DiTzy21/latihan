<?php


namespace App\Http\Controllers;

use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class WishlistController extends Controller
{
    public function index()
    {
        $whishlist = Whishlist::where('user_id', Auth::id())->get();
        return view('home', compact('whishlist'));
    }

    public function store(Request $request)
    {
        $whishlist = new Whishlist();
        $whishlist->user_id = Auth::id();
        $whishlist->product_id = $request->product_id;
        $whishlist->save();
        return redirect('home')->with('success', 'Product added to whishlist.');
        
    }

    public function destroy($id)
    {
        $whishlist = Whishlist::findOrFail($id);
        $whishlist->delete();
        return redirect()->back()->with('success', 'Product removed from whishlist.');
    }
}
