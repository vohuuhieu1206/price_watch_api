<?php

namespace App\Transformers;

use App\Review;
use League\Fractal\TransformerAbstract;

class ReviewTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Review $review)
    {

        return [
            //
            'identifier' => (int)$review->id,
            'name_reviewer' =>(string)$review->reviewer_name,
            'content' => (string)$review->review_content,
            'image' => (string)$review->link_image_review,
            'star' => (string)$review->rating,
            'product' => (string)$review->product,
            'crawlDate' => (string)$review->created_at,
            'crawlUpdate' => (string)$review->updated_at,
            'links' => 
            [
                'rel' => 'products',
                'href' => route('products.show', $review->product_id),
            ],
        ];
    }
    public static function originalAttribute($index){
        $attributes = [
            'identifier' => 'id',
            'name_reviewer' =>'reviewer_name',
            'content' => 'review_content',
            'image' => 'link_image_review',
            'star' => 'rating',
            'product' => 'product',
            'product_id' => 'product_id',
            'crawlDate' => 'created_at',
            'crawlUpdate' => 'updated_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            'id' =>'identifier',
            'reviewer_name' =>'name_reviewer',
            'review_content' =>'content',
            'link_image_review' =>'image',
            'rating' =>'star',
            'product' => 'product',
            'product_id' =>'product_id',
            'created_at' =>'crawlDate',
            'updated_at' =>'crawlUpdate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
}
