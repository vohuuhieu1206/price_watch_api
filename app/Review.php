<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;

    //public $transformer = TransactionTransformer::class;
    protected $date = ['delete_at'];
    protected $fillable = [
    	'reviewer_name',
		'review_content',
		'link_image_review',
		'rating',
		'product_id',
    ];
    protected $hidden = [
        'pivot'
    ];
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
