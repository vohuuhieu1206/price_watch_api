<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProviderTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    //
    use SoftDeletes;

    public $transformer = ProviderTransformer::class;
    protected $date = ['delete_at'];
    protected $fillable = [
    	'provider_name',
        'link_logo'
    ];
    protected $hidden = [
        'pivot'
    ];

    public function products(){
    	return $this->hasMany(Product::class);
    }
}
