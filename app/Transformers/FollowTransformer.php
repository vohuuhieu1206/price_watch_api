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
    public function transform(Follow $follow)
    {
        $product = $follow->product()->pluck('product_name')->first();
        $user = Auth::guard('api')->user()->pluck('name')->first();
        return [
            //
            'identifier' =>(int)$follow->id,
            'nameProduct' => (string)$product,
            'nameUser' => (string)$user,
            'links' => 
            [
                'rel' => 'product',
                'href' => route('products.show', $follow->product_id),
            ],
            [
                'rel' => 'me',
                'href' => route('me.index'),
            ]
        ];
    }
    public f
}
