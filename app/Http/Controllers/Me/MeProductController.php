<?php

namespace App\Http\Controllers\Me;

use App\Follow;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

class MeProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        //
        $user = Auth::guard('api')->user();
        $products = $user->follows()
                        ->whereHas('product')
                        ->with('product')
                        ->get()
                        ->pluck('product');
        foreach($products as $key => $product)
        {
            $price = $product->prices()->orderBy('created_at','DESC')->pluck('product_price')->first();        
            $product["str_price"] = $price;        
            $product["price"] = str_replace('.','', $price);
            if($product["price"] == 0) {
                $products->forget($key);
            }
            else{
                $provider = $product->provider()->pluck('provider_name')->first();
                $product["provider"] = $provider;
            }
        }
        return $this->showAll($products);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $user = Auth::guard('api')->user();
        $user_id = $user->id;
        if($follow = $product->follows()->where('user_id',$user_id))
        {
            $follow->delete();
            return response()->json(['success' => 'Delete success' , 'code' => 200],200);
        }
        else
        {
            return $this->errorResponse("User have not follow product",404);
        }
    }
}
