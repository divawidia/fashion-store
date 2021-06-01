<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction_details extends Model
{
    protected $table='transaction_details';
    protected $fillable = ['transaction_id','product_id','qty','discount','selling_price'];
}
