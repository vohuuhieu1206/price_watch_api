<?php

namespace App\Transformers;

use App\Follow;
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
        return [
            //
            'id' =>(int)$follow->id,
            'product_id' => (int)$follow->product_id,
            'user_id' => (int)$follow->user_id,
        ];
    }
}
