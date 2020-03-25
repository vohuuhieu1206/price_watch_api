<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    //
    use SoftDeletes;

    //public $transformer = TransactionTransformer::class;
    protected $date = ['delete_at'];
    protected $fillable = [
		'user_id',
		'product_id',
    ];
    protected $hidden = [
        'pivot'
    ];
    public function products()
    {
    	return $this->belongsTo(Product::class);
    }
    public function users()
    {
    	return $this->belongsTo(User::class);
    }
}
