<?php

namespace App\Http\Controllers\Follow;
use App\Follow;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Database\QueryException;

class FollowController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::WhereHas('follows')
                       ->with('follows')
                       ->get();
        foreach($users as $key => $user)
        {
            $products = $user->follows()
                            ->whereHas('product')
                            ->with('product')
                            ->get()
                            ->pluck('product');
            foreach($products as $key => $product)
            {
                $price = $product->prices()->orderBy('created_at','DESC')->pluck('product_price')->first();        
                $product["price"] = str_replace('.','', $price);
                if($product["price"] == 0) {
                    $products->forget($key);
                }
                $product["name"] = $product->product_name;
            }
            return $this->showAll($products);
        }                   
        $follows = $users->follows()->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

}
