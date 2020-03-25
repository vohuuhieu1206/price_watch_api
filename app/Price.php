<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    //
    use SoftDeletes;

    //public $transformer = TransactionTransformer::class;
    protected $date = ['delete_at'];
    protected $fillable = [
    	'product_price',
		'product_id',
		'crawled_at',
    ];
    protected $hidden = [
        'pivot'
    ];
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
