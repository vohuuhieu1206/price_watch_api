<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //

    //public $transformer = TransactionTransformer::class;
    protected $fillable = [
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
