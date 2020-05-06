<?php

namespace App\Transformers;


use App\Provider;
use League\Fractal\TransformerAbstract;

class ProviderTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Provider $provider)
    {
        return [
            //
            'identifier' => (int)$provider->id,
            'name' => (string)$provider->provider_name,
            'linkLogo' =>(string)$provider->link_logo,
        ];
    }
    public static function originalAttribute($index){
        $attributes = [
            'identifier' => 'id',
            'name' => 'provider_name',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            'id' => 'identifier',
            'name' => 'provider_name',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
}