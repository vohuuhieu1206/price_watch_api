<?php

namespace App;

use App\Product;
use App\Provider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends Model
{
    //
    use SoftDeletes;

    //public $transformer = CategoryTransformer::class;
    protected $date = ['delete_at'];
    protected $fillable = [
        'display',
        'operating_system',
    	'front_camera',
		'rear_camera',
		'battery',
		'ram',
		'cpu',
        'brand',
        'provider_id'
    ];
    protected $hidden = [
        'pivot'
    ];

    public function products(){
    	return $this->hasMany(Product::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
