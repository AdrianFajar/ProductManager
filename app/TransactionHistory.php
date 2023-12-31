<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    protected $table = "transaction_history";

    protected $fillable = [
        "category_id", "name", "total", "type"
    ];
}
