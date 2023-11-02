<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    protected $fillable = [
        "name",
        "description",
        "picture",
        "category_id",
        "stock",
    ];

    public function product_category()
    {
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }
}
