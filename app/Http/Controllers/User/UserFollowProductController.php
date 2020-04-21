<?php

namespace App\Http\Controllers\User;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserFollowProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
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
            else{
                $provider = $product->provider()->pluck('provider_name')->first();
                $product["provider"] = $provider;
            }
        }
        return $this->showAll($products);
    }
}
