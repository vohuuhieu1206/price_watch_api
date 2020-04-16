<?php

namespace App\Http\Controllers\Product;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductPricesController extends ApiController
{
    // public function __construct()
    // {
       
    //     parent::__construct();
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {

        $prices = $product->prices;
        
        return $this->showAll($prices);
    }

  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function realprice(Product $product)
    {
        $price = $product->prices()->orderBy('created_at','DESC')->first();
        return $this->showOne($price);
    }
 

}
