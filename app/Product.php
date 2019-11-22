<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model 
{

    use SoftDeletes;
    
    /**
     * Define Fillable Fields
     */

    protected $fillable = [
      'name',
      'price',
      'code',
      'photo',
    ];

    /**
     * Define Date Type Fields
     */

    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

}
