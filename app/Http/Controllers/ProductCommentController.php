<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_ids = $request->input("product_ids");
        Log::debug($request->input("description"));
        foreach($product_ids as $id) {
            $comment = new ProductComment;
            $comment->user_id = Auth::user()->id;
            $comment->product_id = $id;
            $comment->comment = $request->input("description");
            $comment->save();
        }

        return response()->json(["success"=> true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = ProductComment::find($id);
        $comment->delete();

        return redirect('comment')->with('success', 'Comment deleted successfully.');
    }
    public function index()
    {
        $comment = ProductComment::where('user_id', Auth::id())->get();
        return view('home', compact('whishlist'));
    }
}

