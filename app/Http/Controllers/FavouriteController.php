<?php


namespace App\Http\Controllers;

use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class FavouriteController extends Controller
{
    public function index()
    {
        $favourite = Whishlist::where('user_id', Auth::id())->get();
        return view('home', compact('favourite'));
    }

    public function store(Request $request)
    {
        $favourite = new Whishlist();
        $favourite->user_id = Auth::id();
        $favourite->product_id = $request->product_id;
        $favourite->save();
        return redirect('home')->with('success', 'Favourite Addedd ❤️');
        
    }

    public function destroy($id)
    {
        $favourite = Whishlist::findOrFail($id);
        $favourite->delete();
        return redirect()->back()->with('success', 'Product removed from whishlist.');
    }
}
