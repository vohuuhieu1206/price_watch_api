<?php

namespace App\Transformers;

use App\Product;
use App\Transformers\PriceTransformer;
use League\Fractal\TransformerAbstract;
use App\Transformers\ProviderTransformer;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    // public $availableIncludes = [
    //     'price','provider'
    // ];
    // protected $defaultIncludes = [
    //     'price','provider'
    // ];
    public function transform(Product $product)
    {
        return [
            //
            'identifier' => (int)$product->id,
            'title' => (string)$product->product_name,
            'link' => (string)$product->product_link,
            'image' => (string)$product->link_image,
            'rating' => (string)$product->average_rating,
            'price'=>(int)$product->price,
            'str_price'=>(string)$product->str_price,
            'provider'=>(string)$product->provider,
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
            'price'=>'price',
            'provider' => 'provider',
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
            'price'=>'price',
            'provider' => 'provider',
            'provider_id' =>'provider_id',
            'specification_id' =>'specification_id',
            'created_at' =>'crawlDate',
            'updated_at' =>'crawlUpdate',
            'deleled_at' =>'deleteDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    // public function includePrice(Product $product)
    // {
    //     $price = $product->prices->sortByDesc('created_at');
    //     return $this->collection($price->take(1), new PriceTransformer());

    // }
    // public function includeProvider(Product $product)
    // {
    //     $provider =$product->provider;
    //     return $this->item($provider, new ProviderTransformer());
    // }

}
