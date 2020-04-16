<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        $price = $product->prices()->orderBy('created_at','DESC')->pluck('product_price')->first();
        $provider = $product->provider()->pluck('provider_name')->first();
        return [
            //
            'identifier' => (int)$product->id,
            'title' => (string)$product->product_name,
            'link' => (string)$product->product_link,
            'image' => (string)$product->link_image,
            'rating' => (string)$product->average_rating,
            'price' => $price,
            'provider' =>$provider,
            'specification_id' => (int)$product->specification_id,
            'crawlDate' => (string)$product->created_at,
            'crawlUpdate' => (string)$product->updated_at,
            'deleteDate' => isset($product->deleled_at) ? (string) $product->deleted_at : null,

            'links' => 
            [
                'rel' => 'self',
                'href' => route('products.show', $product->id),
            ],
            [
                'rel' => 'products.provider',
                'href' => route('products.provider.index', $product->id),
            ],
            [
                'rel' => 'products.specification',
                'href' => route('products.specification.index', $product->id),
            ],
            [
                'rel' => 'products.reviews',
                'href' => route('products.reviews.index', $product->id),
            ],
            [
                'rel' => 'products.prices',
                'href' => route('products.prices.index', $product->id),
            ],
        ];
    }
    public static function originalAttribute($index){
        $attributes = [
            //
            'identifier' => 'id',
            'title' => 'product_name',
            'link' => 'product_link',
            'image' => 'link_image',
            'rating' => 'average_rating',
            'provider_id' => 'provider_id',
            'specification_id' => 'specification_id',
            'crawlDate' => 'created_at',
            'crawlUpdate' => 'updated_at',
            'deleteDate' => 'deleled_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            //
            'id' =>'identifier',
            'product_name' =>'title',
            'product_link' =>'link',
            'link_image' =>'image',
            'average_rating' =>'rating',
            'provider_id' =>'provider_id',
            'specification_id' =>'specification_id',
            'created_at' =>'crawlDate',
            'updated_at' =>'crawlUpdate',
            'deleled_at' =>'deleteDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
}
