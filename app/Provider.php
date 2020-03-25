<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    //
    use SoftDeletes;

    //public $transformer = CategoryTransformer::class;
    protected $date = ['delete_at'];
    protected $fillable = [
    	'provider_name',
    ];
    protected $hidden = [
        'pivot'
    ];

    public function products(){
    	return $this->belongsToMany(Product::class);
    }
}
