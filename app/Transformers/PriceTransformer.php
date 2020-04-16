<?php

namespace App\Transformers;

use App\Price;
use League\Fractal\TransformerAbstract;

class PriceTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Price $price)
    {
        $product = $price->product()->pluck('product_name')->first();
        return [
            //
            'identifier' => (int)$price->id,
            'product' => $product,
            'price' => (string)$price->product_price,
            'crawlDate' => (string)$price->created_at,
            'links' => 
            [
                'rel' => 'products',
                'href' => route('products.show', $price->product_id),
            ],
        ];
    }
    public static function originalAttribute($index){
        $attributes = [
            'identifier' => 'id',
            'product_id' => 'product_id',
            'price' => 'product_price',
            'crawlDate' => 'created_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            'id' => 'identifier',
            'product_id' => 'product_id',
            'product_price' => 'price',
            'created_at' => 'crawlDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
}
