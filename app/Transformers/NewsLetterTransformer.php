<?php

namespace App\Transformers;

use App\NewsLetter;
use League\Fractal\TransformerAbstract;

class NewsLetterTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(NewsLetter $newsletter)
    {
        return [
            'identifier' => (int)$newsletter->id,
            'guestName' => (string)$newsletter->guest_name,
            'emailName' => (string)$newsletter->guest_email,
        ];
    }
    public static function originalAttribute($index){
        $attributes = [
            'identifier' => 'id',
            'guestName' => 'guest_name',
            'emailName' => 'guest_email',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
    public static function transformedlAttribute($index){
        $attributes = [
            'id' => 'identifier',
            'guest_name' => 'guestName',
            'guest_email' => 'emailName',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null ;
    }
}