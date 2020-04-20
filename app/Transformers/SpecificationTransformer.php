<?php

namespace App\Transformers;

use App\Specification;
use League\Fractal\TransformerAbstract;

class SpecificationTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Specification $specification){
        $id_product = $specification->products()->pluck('id')->first();
        return [
            //
            'identifier' => (int)$specification->id,
            'display' => (string)$specification->display,
            'os' => (string)$specification->operating_system,
            'frontCamera' => (string)$specification->front_camera,
            'rearCamera' => (string)$specification->rear_camera,
            'batteryCapacity' => (string)$specification->battery,
            'ram' => (string)$specification->ram,
            'cpu' => (string)$specification->cpu,
            'brand' => (string)$specification->brand,
            'storage' => (string)$specification->storage,
            'product' =>(string)$specification->product,
            'crawlDate' =>(string)$specification->created_at,
            'crawlUpdate' =>(string)$specification->updated_at,
            [
                'rel' => 'products',
                'href' => route('products.show', $id_product),
            ],
        ];
    }
    public static function originalAttribute($index){
        $attributes = [
            'identifier' =>'id',
            'display' => 'display',
            'os' => 'operating_system',
            'frontCamera' => 'front_camera',
            'rearCamera' => 'rear_camera',
            'batteryCapacity' => 'battery',
            'ram' => 'ram',
            'cpu' => 'cpu',
            'product' => 'product',
            'brand' => 'brand',
            'storage' => 'storage',
            'product_id' =>'product_id',
            'crawlDate' =>'created_at',
            'crawlUpdate' =>'updated_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            'id' =>'identifier',
            'display' =>'display',
            'operating_system' =>'os',
            'front_camera' =>'frontCamera',
            'rear_camera' =>'rearCamera',
            'battery' =>'batteryCapacity',
            'ram' =>'ram',
            'cpu' =>'cpu',
            'product' => 'product',
            'brand' =>'brand',
            'storage' =>'storage',
            'product_id' =>'product_id',
            'created_at' =>'crawlDate',
            'updated_at' =>'crawlUpdate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
}
