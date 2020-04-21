<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Transformers\NewsLetterTransformer;

class NewsLetter extends Model
{
    //
    use Notifiable;
   	public $transformer = NewsLetterTransformer::class;
    protected $table = 'news_letters';

    protected $fillable = [
        'guest_name',
        'guest_email',
    ];

}
