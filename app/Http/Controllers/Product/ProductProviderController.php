<?php

namespace App\Http\Controllers\Product;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductProviderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        //
        $provider = $product->provider;
        
        return $this->showOne($provider);
    }
}
