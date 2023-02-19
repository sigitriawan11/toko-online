<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'product_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $with = ['category'];

    public function getRouteKeyName(){
        return 'product_code';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
