<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{
    public function __construct()
    {
        
        // $this->middleware('client.credentials')->only(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $array = array();
        $products = Product::all();
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
                $link_logo = $product->provider()->pluck('link_logo')->first();
                $product["provider"] = $provider;
                $product["link_logo"] = $link_logo;
            }
        }

        return $this->showAll($products);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        $price = $product->prices()->orderBy('created_at','DESC')->pluck('product_price')->first();        
        $product["str_price"] = $price;        
        $product["price"] = str_replace('.','', $price);
        $provider = $product->provider()->pluck('provider_name')->first();
        $link_logo = $product->provider()->pluck('link_logo')->first();
        $product["provider"] = $provider;
        $product["link_logo"] = $link_logo;
        return $this->showOne($product);
    }

   
}
