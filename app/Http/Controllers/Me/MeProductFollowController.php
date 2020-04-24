<?php

namespace App\Http\Controllers\Me;

use App\Follow;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

class MeProductFollowController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product,Request $request)
    {
        $user = Auth::guard('api')->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['product_id'] =$product->id;        
        $follow = Follow::create($data);

        $price = $product->prices()->orderBy('created_at','DESC')->pluck('product_price')->first();        
        $product["price"] = str_replace('.','', $price);
        $provider = $product->provider()->pluck('provider_name')->first();
        $product["provider"] = $provider;
        return $this->showOne($product); 
    }

}
