<?php

namespace App;

use App\User;
use App\Product;
use App\Transformers\FollowTransformer;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //

    public $transformer = FollowTransformer::class;
    protected $fillable = [
		'id',
        'user_id',
		'product_id',
    ];
    protected $hidden = [
        'pivot'
    ];
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
