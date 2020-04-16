<?php

namespace App\Http\Controllers\Product;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductSpecificationController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {

        $specification = $product->specification;
        
        return $this->showOne($specification);
    }
}
