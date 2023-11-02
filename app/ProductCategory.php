<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "product_category";

    protected $fillable = [
        "name", "description"
    ];

    public function products()
    {
        return $this->hasMany('App\Product', 'category_id', 'category_id');
    }
}
