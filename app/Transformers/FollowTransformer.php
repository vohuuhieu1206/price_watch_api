<?php

namespace App\Transformers;

use App\Follow;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class FollowTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform()
    {
        return [
            //
            'identifier' =>(int)$follow->id,
            'nameProduct' => (string)$follow->nameProduct,
            'price'=>(int)$follow->price,
        ];
    }
    public static function originalAttribute($index){
         $attributes = [
            //
            'identifier' => 'id',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            //
            'id' => 'identifier',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    } 
}
